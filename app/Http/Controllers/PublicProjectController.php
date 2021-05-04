<?php

namespace App\Http\Controllers;

use App\project;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\reg_std;
use App\Teacher;
use App\subject;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\project_instructor;
use App\project_user;
use App\subject_student;
use Illuminate\Support\Facades\Storage;
use App\Project_File;
use App\test50;
use App\test100;
use App\ProgressReport_test50;
use App\ProgressReport_test100;
use App\CompleteForm;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Notifications\InvoicePaid;
use App\changetopic;
use App\ChangeBoard;
use App\Permission;
use App\Role;
use App\Http\Controllers\DataTableController;
use SebastianBergmann\CodeCoverage\Report\Xml\Project as XmlProject;
use App\comment_test50;
use App\comment_test100;
use Doctrine\DBAL\Schema\View;
use App\point_test50;
use App\point_test100;
use App\pointTest;
use App\reject_test;
use App\CollectPoints;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class PublicProjectController extends Controller
{
    public function public_project()
    {
        if (Auth::user()->hasRole('Admin')) {
            $project = project::where('status', 'Private')->orWhere('status', 'Public')->paginate(10);
            // return response()->json($project);

            return view('Admin.project.public_project', compact('project'));
        } else {
            abort(404);
        }
    }
    public function search_public_projec(Request $request)
    {
        if (Auth::user()->hasRole('Admin')) {
            $project = project::where([['status', 'Private'], ['status', 'Public']])
                ->orWhere('name_th', 'LIKE', "%{$request->search}%")
                ->orWhere('name_en', 'LIKE', "%{$request->search}%")
                ->orWhere('number_project', 'LIKE', "%{$request->search}%")
                ->orWhere('keyword_th', 'LIKE', "%{$request->search}%")
                ->orWhere('keyword_eng', 'LIKE', "%{$request->search}%")

                ->paginate(10);
            // return response()->json($project);

            return view('Admin.project.public_project', compact('project'));
        } else {
            abort(404);
        }
    }
    public function view_public_projec($id)
    {


        $datas = project::join('project_users', 'projects.id', '=', 'project_users.Project_id')
            ->join('complete_forms', 'projects.id', '=', 'complete_forms.Project_id_CompleteForm')
            ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
            ->join('subjects', 'projects.subject_id', '=', 'subjects.id')
            ->select('projects.*', 'project_users.*', 'reg_stds.*', 'complete_forms.*', 'subjects.*')->where([

                ['projects.id', '=', $id],
                ['project_users.deleted_at', null],
                ['complete_forms.deleted_at', null],
                ['complete_forms.status_CompleteForm', '=', 'Successfully']
            ])->get();
        $datas_instructor = project::join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
            ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
            ->select('teachers.*', 'project_instructors.Is_president')->where([['projects.id', '=', $id], ['projects.deleted_at', null]])->get();

        $data_project = project::find($id);

        $data_file = Project_File::orderBy('id', 'desc')->where([['Project_id_File', $id], ['status_file_path', 'Public']])->first();

        // return response()->json($datas);
        return view('Admin.project.view_public_project', compact('datas', 'datas_instructor', 'data_project', 'data_file'));
    }
    public function edit_public_projec($id)
    {
        if (Auth::user()->hasRole('Admin')) {

            $datas = project::join('project_users', 'projects.id', '=', 'project_users.Project_id')
                ->join('complete_forms', 'projects.id', '=', 'complete_forms.Project_id_CompleteForm')
                ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
                ->join('subjects', 'projects.subject_id', '=', 'subjects.id')
                ->select('projects.*', 'project_users.*', 'reg_stds.*', 'complete_forms.*')->where([
                    ['projects.id', '=', $id],
                    ['project_users.deleted_at', null],
                    ['complete_forms.deleted_at', null],
                    ['complete_forms.status_CompleteForm', '=', 'Successfully']
                ])->get();
            $datas_instructor = project::join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where([['projects.id', '=', $id], ['projects.deleted_at', null]])->get();

            $data_project = project::find($id);

            $data_file = Project_File::orderBy('id', 'desc')->where('Project_id_File', $id)->first();
            // return response()->json($datas);
            return view('Admin.project.edit_public_project', compact('datas', 'datas_instructor', 'data_project', 'data_file'));
        } else {
            abort(404);
        }
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'abstract_th' => 'required',
            'keyword_th' => 'required',
            'abstract_eng' => 'required',
            'keyword_eng' => 'required',
            'Status' => 'required',
            'Status_File' => 'required',
            'Number_project' => 'required'
        ]);

        $data = project::find($id);
        $data->abstract_th = $request->abstract_th;
        $data->keyword_th = $request->keyword_th;
        $data->abstract_eng = $request->abstract_eng;
        $data->keyword_eng = $request->keyword_eng;
        $data->status = $request->Status;
        $data->number_project =  $request->Number_project;
        $data->save();
        // return response()->json($request->File);
        if ($request->File != null) {
            $fileModel = Project_File::where('Project_id_File', $id)->delete();

            $fileModel = new Project_File;
            $fileModel->name_file = time() . '_' .  $request->Number_project . '.zip';;
            $fileModel->status_file_path = $request->Status_File;
            $fileModel->Project_id_File = $id;
            $fileModel->save();
            //  return response()->json($project_id);
            Storage::disk('local')->putFileAs(
                'Successfully',
                $request->File,
                $fileModel->name_file
            );
        } elseif (empty($request->File)) {
            $fileModel = Project_File::where('Project_id_File', $id)->first();
            // $fileModel->name_file = time() . '_' .  $request->Number_project . '.zip';;
            $fileModel->status_file_path = $request->Status_File;
            // $fileModel->Project_id_File = $id;
            $fileModel->save();
        }

        // $data->Status_File = $request->Status_File;
        return redirect('/public_project');
        // return response()->json($request);
    }
    public function download($form, $file)
    {
        return response()->download(storage_path("/app/{$form}/{$file}"));
    }

    public function search_Guest_public_project(Request $request)
    {
        $project = project::Where('status', 'Public')
            ->orWhere('name_th', 'LIKE', "%{$request->search}%")
            ->orWhere('name_en', 'LIKE', "%{$request->search}%")
            ->orWhere('number_project', 'LIKE', "%{$request->search}%")
            ->orWhere('keyword_th', 'LIKE', "%{$request->search}%")
            ->orWhere('keyword_eng', 'LIKE', "%{$request->search}%")
            ->paginate(10);

        // return response()->json($project);

        return view('info_word_template.Guest_public_project', compact('project'));
    }
}
