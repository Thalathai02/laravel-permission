<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\reg_std;
use App\project;
use App\Teacher;
use App\subject;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\project_instructor;
use App\project_user;
use App\subject_student;
use Illuminate\Support\Facades\Storage;
use App\Project_File;
use http\Env\Response;
use SebastianBergmann\CodeCoverage\Report\Xml\Project as XmlProject;

class CheckProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->hasRole('Admin')) {
            $datas = project::orderBy('id', 'ASC')->get();
            
            return view('projects.Check_Project', compact('datas'));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $datas_instructor = DB::table('projects')
            ->join('project_instructor', 'projects.id', '=', 'project_instructor.Project_id')
            ->join('teachers', 'project_instructor.ID_Instructor', '=', 'teachers.id')
            ->select('teachers.*')->where('projects.id', '=', $id)->get();
            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $id]])->get();
        $user = $request->user();

        
            if (!empty($datas_instructor[0]->id)) {
                $datas_std = DB::table('projects')
                    ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
                    ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                    ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
                    ->join('subjects', 'projects.subject_id', '=', 'subjects.id')
                    ->select('reg_stds.*', 'project__files.*', 'subjects.*')->where([['projects.id', '=', $id], ['project__files.status_file_path', '=', 'Waiting']])->get();
                return view('projects.info_project', compact('datas', 'datas_std', 'datas_instructor'));
            } else {
                $datas_std = DB::table('projects')
                    ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
                    ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                    ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
                    ->join('subjects', 'projects.subject_id', '=', 'subjects.id')
                    ->select('projects.*', 'project_user.*', 'reg_stds.*', 'project__files.*', 'subjects.*')->where([['projects.id', '=', $id], ['project__files.status_file_path', '=', 'Waiting']])->get();
                return view('projects.info_project', compact('datas_std', 'datas'));
            }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = $request->user();

        if ($user->hasRole('Admin')) {
            $datas1 = DB::table('projects')
                ->join('project_instructor', 'projects.id', '=', 'project_instructor.Project_id')
                ->join('teachers', 'project_instructor.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $id)->get();
            // return response()->json([
            //     'id' => $datas1
            // ]);

            $name_Instructor = Teacher::pluck('name_Instructor', 'id');
            if (empty($datas1)) {

                $datas = DB::table('projects')
                    ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
                    ->join('project_instructor', 'projects.id', '=', 'project_instructor.Project_id')
                    ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')


                    ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
                    ->join('teachers', 'project_instructor.ID_Instructor', '=', 'teachers.id')
                    ->select('projects.*', 'project_user.*', 'reg_stds.*', 'teachers.*', 'project__files.*')->where([['projects.id', '=', $id], ['project__files.status_file_path', '=', 'Waiting']])->get();
                    return view('projects.instructor_project', compact('datas','name_Instructor'));
            } else {
                $datas = DB::table('projects')
                    ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
                    ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                    ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
                    ->select('projects.*', 'project_user.*', 'reg_stds.*', 'project__files.*')->where([['projects.id', '=', $id], ['project__files.status_file_path', '=', 'Waiting']])->get();
                    return view('projects.instructor_project', compact('datas','name_Instructor'));
            }
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $request->user();

        if ($user->hasRole('Admin')) {
            project::find($id)->update(['status'=>'Check']);

            if (!empty($request->get('name_president'))) {
                $Search_name_president = $request->get('name_president');
                $name_president = Teacher::query()->where('id', 'LIKE', "%{$Search_name_president}%")->get();
                if ($Search_name_president === "-") {
                } else {
                    $this->Database_Project_instructor($id, 'ID_Instructor', $name_president, $action = "Is_president", $is_action = 1);
                }
            }
            if (!empty($request->get('name_director1'))) {
                $Search_name_director1 = $request->get('name_director1');
                $name_director1 = Teacher::query()->where('id', 'LIKE', "%{$Search_name_director1}%")->get();
                if ($Search_name_director1 === "-") {
                } else {
                    $this->Database_Project_instructor($id, 'ID_Instructor', $name_director1, $action = "Is_director", $is_action = 1);
                }
            }
            if (!empty($request->get('name_director2'))) {
                $Search_name_director2 = $request->get('name_director2');
                $name_director2 = Teacher::query()->where('id', 'LIKE', "%{$Search_name_director2}%")->get();
                if ($Search_name_director2 === "-") {
                } else {
                    $this->Database_Project_instructor($id, 'ID_Instructor', $name_director2, $action = "Is_director", $is_action = 1);
                }
            }
            // DB::table('projects')->where('id', $id)->update(['id_regStd1' => $data[0]->id, 'id_regStd2' => $data2[0]->id]);

            // return response()->json([
            //     'id' => $id,
            //     'reg_1' => $name_president,
            //     'reg_2' => $name_director1,
            //     'reg_3' => $name_director2 ,

            // ]);
            return redirect('/Check_Project');
        } else {
            abort(404);
        }
    }
    public function Database_Project_instructor($id, $table, $data, $action, $is_action)
    {
        DB::table('project_instructor')->updateOrInsert([$table => $data[0]->id, "Project_id" => $id, $action => $is_action]);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('projects')->where('id', '=', $id)->update(['status' => "reject"]);
        DB::table('project__files')->where('id', '=', $id)->update(['status_file_path' => "reject"]);
        return redirect('/Check_Project');
    }

    public function download($year, $term, $file)
    {
        // return response()->json([
        //     $year,
        //     $term,
        //    $file ,
        //     ]);
        return response()->download(storage_path('/app/Waiting/' . $year . '/' . $term . '/' . $file));
        // return Storage::download($file, $file, '/app/Waiting/' . $year . '/' . $term . '/');
    }
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $data = reg_std::where('std_code', 'LIKE', $request->reg_std . '%')->get();
            $output = '';
            if (count($data) > 0) {
                foreach ($data as $row) {
                    $output = '<p>' .'ชื่อ ' . $row->name . '</p>';
                }
            } else {
                $output .= '<p>' . 'No results' . '</p>';
            }
            return $output;
        }
    }
}
