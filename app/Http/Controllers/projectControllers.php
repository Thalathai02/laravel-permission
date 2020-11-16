<?php

namespace App\Http\Controllers;

use App\project;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\reg_std;
use App\Teacher;
use App\subject;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Project_Instructor;
use App\project_user;
use App\subject_student;
use Illuminate\Support\Facades\Storage;
use App\Project_File;

class projectControllers extends Controller
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
            $datas = DB::table('projects')
                ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
                // ->join('project_instructor','projects.id','=', 'project_instructor.Project_id')
                ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
                // ->join('teachers','project_instructor.ID_Instructor','=', 'teachers.id')
                ->select('projects.*', 'project_user.*', 'reg_stds.*')->get();

            return view('projects.projects', compact('datas'));
        }
        if ($user->hasRole('Std')) {
            $user = $request->user()->id;
            $data_std1 = DB::table('reg_stds')->where('user_id', $user)->select('reg_stds.id')->get();
            $data_std = DB::table('project_user')->where('id_reg_Std', $data_std1[0]->id)->select('project_user.*')->get();
            if (!empty($data_std[0]->id)) {
                $reject = DB::table('projects')->where('id', '=', $data_std[0]->Project_id)->select('projects.status')->get();
                $datas = DB::table('projects')
                    ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
                    // ->join('project_instructor','projects.id','=', 'project_instructor.Project_id')
                    ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
                    // ->join('teachers','project_instructor.ID_Instructor','=', 'teachers.id')
                    ->select('projects.*', 'project_user.*', 'reg_stds.*')->get();
                if ($reject[0]->status == "reject") {
                    return view('projects.projects', compact('datas', 'data_std', 'reject'));
                } else {
                    $reject = null;
                    return view('projects.projects', compact('datas', 'data_std', 'reject'));
                }
            } else {
                $data_std = null;
                $reject = null;
                $datas = DB::table('projects')
                    ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
                    // ->join('project_instructor','projects.id','=', 'project_instructor.Project_id')
                    ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
                    // ->join('teachers','project_instructor.ID_Instructor','=', 'teachers.id')
                    ->select('projects.*', 'project_user.*', 'reg_stds.*')->get();

                return view('projects.projects', compact('datas', 'data_std', 'reject'));
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('Admin')) {
            $term = subject::pluck('year_term', 'id');
            return view('projects.into_project', compact('term'));
        }
        if ($user->hasRole('Std')) {
            $term = $request->user()->id;
            $term = subject_student::find($term);
            $term = subject::find($term);
            return view('projects.into_project', compact('term'));
        } else {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            $Search = $request->get('reg_std1');
            $data = reg_std::query()->where('std_code', 'LIKE', "{$Search}")->get();
            DB::table('project_user')->updateOrInsert(['id_reg_Std' => $data[0]->id, "Project_id" => $id, 'isHead' => 1, 'name_mentor' => $request->get('name_mentor')]);
            if (!empty($request->get('reg_std2'))) {
                $Search2 = $request->get('reg_std2');
                $data2 = reg_std::query()->where('std_code', 'LIKE', "{$Search2}")->get();
                if ($Search2 === "-") {
                } else {
                    $this->DataBase($id, 'id_reg_Std', $data2);
                }
            }
            if (!empty($request->get('reg_std3'))) {
                $Search3 = $request->get('reg_std3');
                $data3 = reg_std::query()->where('std_code', 'LIKE', "{$Search3}")->get();
                if ($Search3 === "-") {
                } else {
                    $this->DataBase($id, 'id_reg_Std', $data3);
                }
            }
            if (!empty($request->get('name_president'))) {
                $Search_name_president = $request->get('name_president');
                $name_president = Teacher::query()->where('name_Instructor', 'LIKE', "%{$Search_name_president}%")->get();
                if ($Search_name_president === "-") {
                } else {
                    $this->Database_Project_instructor($id, 'ID_Instructor', $name_president, $action = "Is_president", $is_action = 1);
                }
            }
            if (!empty($request->get('name_director1'))) {
                $Search_name_director1 = $request->get('name_director1');
                $name_director1 = Teacher::query()->where('name_Instructor', 'LIKE', "%{$Search_name_director1}%")->get();
                if ($Search_name_director1 === "-") {
                } else {
                    $this->Database_Project_instructor($id, 'ID_Instructor', $name_director1, $action = "Is_director", $is_action = 1);
                }
            }
            if (!empty($request->get('name_director2'))) {
                $Search_name_director2 = $request->get('name_director2');
                $name_director2 = Teacher::query()->where('name_Instructor', 'LIKE', "%{$Search_name_director2}%")->get();
                if ($Search_name_director2 === "-") {
                } else {
                    $this->Database_Project_instructor($id, 'ID_Instructor', $name_director2, $action = "Is_director", $is_action = 1);
                }
            }
            // DB::table('projects')->where('id', $id)->update(['id_regStd1' => $data[0]->id, 'id_regStd2' => $data2[0]->id]);

            return response()->json([
                'id' => $id,
                'reg_std1' => $data,
                'reg_std2' => $data2,
                'reg_std3' => $data3,

            ]);
        }
        if ($user->hasRole('Std')) {
            $Search = $request->get('reg_std1');
            $data = reg_std::query()->where('std_code', 'LIKE', "{$Search}")->get();
            DB::table('project_user')->updateOrInsert(['id_reg_Std' => $data[0]->id, "Project_id" => $id, 'isHead' => 1, 'name_mentor' => $request->get('name_mentor')]);
            if (!empty($request->get('reg_std2'))) {
                $Search2 = $request->get('reg_std2');
                $data2 = reg_std::query()->where('std_code', 'LIKE', "{$Search2}")->get();
                if ($Search2 === "-") {
                } else {
                    $this->DataBase($id, 'id_reg_Std', $data2);
                }
            }
            if (!empty($request->get('reg_std3'))) {
                $Search3 = $request->get('reg_std3');
                $data3 = reg_std::query()->where('std_code', 'LIKE', "{$Search3}")->get();
                if ($Search3 === "-") {
                } else {
                    $this->DataBase($id, 'id_reg_Std', $data3);
                }
            }
            if (!empty($request->get('name_president'))) {
                $Search_name_president = $request->get('name_president');
                $name_president = Teacher::query()->where('name_Instructor', 'LIKE', "%{$Search_name_president}%")->get();
                if ($Search_name_president === "-") {
                } else {
                    $this->Database_Project_instructor($id, 'ID_Instructor', $name_president, $action = "Is_president", $is_action = 1);
                }
            }
            if (!empty($request->get('name_director1'))) {
                $Search_name_director1 = $request->get('name_director1');
                $name_director1 = Teacher::query()->where('name_Instructor', 'LIKE', "%{$Search_name_director1}%")->get();
                if ($Search_name_director1 === "-") {
                } else {
                    $this->Database_Project_instructor($id, 'ID_Instructor', $name_director1, $action = "Is_director", $is_action = 1);
                }
            }
            if (!empty($request->get('name_director2'))) {
                $Search_name_director2 = $request->get('name_director2');
                $name_director2 = Teacher::query()->where('name_Instructor', 'LIKE', "%{$Search_name_director2}%")->get();
                if ($Search_name_director2 === "-") {
                } else {
                    $this->Database_Project_instructor($id, 'ID_Instructor', $name_director2, $action = "Is_director", $is_action = 1);
                }
            }
            // DB::table('projects')->where('id', $id)->update(['id_regStd1' => $data[0]->id, 'id_regStd2' => $data2[0]->id]);

            return response()->json([
                'id' => $id,
                'reg_std1' => $data,
                'reg_std2' => $data2,
                'reg_std3' => $data3,
            ]);
        } else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function DataBase($id, $table, $data)
    {
        DB::table('project_user')->updateOrInsert([$table => $data[0]->id, "Project_id" => $id, 'isHead' => 0]);
    }
    public function Database_Project_instructor($id, $table, $data, $action, $is_action)
    {
        DB::table('project_instructor')->updateOrInsert([$table => $data[0]->id, "Project_id" => $id, $action => $is_action]);
    }

    public function createNameProject(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'Project_name_thai' => 'required',
            'Project_name_eg' => 'required',
            'File' => 'required|file|mimes:zip',
            'subject',
        ]);
        $fileModel = new Project_File;

        if ($user->hasRole('Admin')) {
            $request->validate([
                'Project_name_thai' => 'required',
                'Project_name_eg' => 'required',
                'File' => 'required|file|mimes:zip',
                'subject' => 'required',
            ]);
            $name = new project();
            $name->name_th = $request['Project_name_thai'];
            $name->name_en = $request['Project_name_eg'];
            $name->status = "not Check";
            $name->subject_id = $request['subject'];

            $name->save();
            $id =  $name->id;
            $data_nameProject = project::find($id);

            $fileModel->name_file = time() . '_' . $request->File->getClientOriginalName();
            $fileModel->file_path = 'not Check/';
            $fileModel->status_file_path = "not Check";
            $fileModel->Project_id_File = $name->id;

            // $request->File->store("not Check");

            Storage::disk('local')->putFileAs(
                'not Check/',
                $request->File,
                $fileModel->name_file
              );

            $fileModel->save();
            return view('/projects/list_name', compact("data_nameProject"));
        }
        if ($user->hasRole('Std')) {
            $term = $request->user()->id;
            $term = subject_student::find($term);
            $term = subject::find($term);
            $name = new project();
            $name->name_th = $request['Project_name_thai'];
            $name->name_en = $request['Project_name_eg'];
            $name->status = "not Check";
            $name->subject_id = $term[0]->id;

            $name->save();
            $id =  $name->id;
            $data_nameProject = project::find($id);
            $term = $request->user()->id;
            $term = reg_std::query()->where('user_id', 'LIKE', $term)->get();
            $fileModel->name_file = time() . '_' . $request->File->getClientOriginalName();
            $fileModel->file_path = 'not Check/';
            $fileModel->status_file_path = "not Check";
            $fileModel->Project_id_File = $name->id;
            
            Storage::disk('local')->putFileAs(
                'not Check/',
                $request->File,
                $fileModel->name_file
              );
            $fileModel->save();
            return view('/projects/list_name', compact("data_nameProject", "term"));
        } else {
            abort(404);
        }
    }
}
