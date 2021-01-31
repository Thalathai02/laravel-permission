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

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->hasRole('Std')) {
            $id = Auth::user()->id;
            $mydata = User::find($id);
            $data_reg1 = reg_std::where('user_id', $mydata->id)->get();
            $id_stu_project = project_user::query()->where('id_reg_Std', $data_reg1[0]->id)->get();
            if ($id_stu_project == '[]') {
                return view('home');
                // return response()->json($id_stu_project );
            }
            $datas_instructor = DB::table('projects')
                ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $id_stu_project[0]->Project_id)->get();
            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=',  $id_stu_project[0]->Project_id]])->get();
            $user = Auth::user();
            if (!empty($datas_instructor[0]->id)) {
                $datas_std = DB::table('projects')
                    ->join('project_users', 'projects.id', '=', 'project_users.Project_id')
                    ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                    ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
                    ->join('subjects', 'projects.subject_id', '=', 'subjects.id')
                    ->select('reg_stds.*', 'project__files.*', 'subjects.*')->where([['projects.id', '=', $id_stu_project[0]->Project_id], ['project__files.status_file_path', '=', 'Waiting']])->get();
                return view('home', compact('datas', 'datas_std', 'datas_instructor'));
            } else {
                $datas_std = DB::table('projects')
                    ->join('project_users', 'projects.id', '=', 'project_users.Project_id')
                    ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                    ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
                    ->join('subjects', 'projects.subject_id', '=', 'subjects.id')
                    ->select('projects.*', 'project_users.*', 'reg_stds.*', 'project__files.*', 'subjects.*')->where([['projects.id', '=', $id_stu_project[0]->Project_id], ['project__files.status_file_path', '=', 'Waiting']])->get();
                return view('home', compact('datas_std', 'datas'));
            }
        }
        return view('home');
    }
}
