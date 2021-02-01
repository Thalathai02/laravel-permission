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
use SebastianBergmann\CodeCoverage\Report\Xml\Project as XmlProject;

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
            $datas = project::orderBy('id', 'ASC')->paginate(10);
            return view('projects.projects', compact('datas'));
        }
        if ($user->hasRole('Tea')) {
            $datas = project::orderBy('id', 'ASC')->paginate(10);

            return view('projects.projects', compact('datas'));
        }
        if ($user->hasRole('Std')) {
            $user = $request->user()->id;
            $data_std1 = DB::table('reg_stds')->where('user_id', $user)->select('reg_stds.id')->get();
            $data_std = DB::table('project_users')->where('id_reg_Std', $data_std1[0]->id)->select('project_users.*')->get();
            if (!empty($data_std[0]->id)) {
                $status = DB::table('projects')->where('id', '=', $data_std[0]->Project_id)->select('projects.status')->get();
                $datas = project::orderBy('id', 'ASC')->paginate(10);
                if ($status[0]->status == "reject") {
                    return view('projects.projects', compact('datas', 'data_std', 'status'));
                } elseif ($status[0]->status == "Waiting") {
                    return view('projects.projects', compact('datas', 'data_std', 'status'));
                } elseif ($status[0]->status == "Check") {
                    return view('projects.projects', compact('datas', 'data_std', 'status'));
                } else {
                    $status = null;
                    return view('projects.projects', compact('datas', 'data_std', 'status'));
                }
            } else {
                $data_std = null;
                $status = null;
                $datas = project::orderBy('id', 'ASC')->paginate(10);
                return view('projects.projects', compact('datas', 'data_std', 'status'));
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
            $user_id = $request->user()->reg_std_id;
            $term = subject_student::where('student_id',$user_id)->get();
            $term = subject::find($term[0]->subject_id);
            // return response()->json($term);
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
    public function edit(Request $request, $id)
    {
        $id_user = Auth::user()->id;
        $user = $request->user();
        $name_Instructor = Teacher::pluck('name_Instructor', 'id');
        if ($user->hasRole('Admin')) {
            $datas_instructor = DB::table('projects')
                ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_users', 'projects.id', '=', 'project_users.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $id]])->get();
            return view('projects.Edit_Project.index', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        }
         if ($user->hasRole('Std')) {
             $id_reg = reg_std::where('user_id',$id)->get();
             $id_reg_Std = project_user::where('id_reg_Std',$id_reg[0]->id)->get();
            //  return response()->json($id_reg_Std[0]->id);
            $datas_instructor = DB::table('projects')
                ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $id_reg_Std[0]->id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $id_reg_Std[0]->id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_users', 'projects.id', '=', 'project_users.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $id_reg_Std[0]->id]])->get();
            return view('projects.Edit_Project.index', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
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
            $Search = $request->get('reg_std1');
            $data = reg_std::query()->where('std_code', 'LIKE', "{$Search}")->get();
            DB::table('project_users')->updateOrInsert(['id_reg_Std' => $data[0]->id, "Project_id" => $id, 'isHead' => 1, 'name_mentor' => $request->get('name_mentor')]);
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
            DB::table('project_users')->updateOrInsert(['id_reg_Std' => $data[0]->id, "Project_id" => $id, 'isHead' => 1, 'name_mentor' => $request->get('name_mentor')]);
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
                $name_president = Teacher::query()->where('id', 'LIKE', "%{$Search_name_president}%")->get();
                if ($Search_name_president === "-") {
                } else {
                    $this->Database_Project_instructor($id, 'id', $name_president, $action = "Is_president", $is_action = 1);
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
        DB::table('project_users')->updateOrInsert([$table => $data[0]->id, "Project_id" => $id, 'isHead' => 0]);
    }
    public function Database_Project_instructor($id, $table, $data, $action, $is_action)
    {
        DB::table('project_instructors')->updateOrInsert([$table => $data[0]->id, "Project_id" => $id, $action => $is_action]);
    }

    public function createNameProject(Request $request)
    {
        $user = $request->user();
        $name_Instructor = Teacher::pluck('name_Instructor', 'id');
        $request->validate([
            'Project_name_thai' => 'required',
            'Project_name_eg' => 'required',
            'File' => 'required|file|mimes:zip',

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
            $name->status = "Waiting";
            $name->subject_id = $request['subject'];

            $term = subject::query()->where('id', 'LIKE', "%{$request['subject']}%")->get();

            $name->save();
            $id =  $name->id;
            $data_nameProject = project::find($id);

            $fileModel->name_file = time() . '_' . $request->File->getClientOriginalName();
            $fileModel->status_file_path = "Waiting";
            $fileModel->Project_id_File = $name->id;

            // $request->File->store("Waiting");

            Storage::disk('local')->putFileAs(
                'Waiting/' . $term[0]->year_term,
                $request->File,
                $fileModel->name_file
            );

            $fileModel->save();
            return view('/projects/list_name', compact("data_nameProject", "name_Instructor"));
        }
        if ($user->hasRole('Std')) {
            $user_id = $request->user()->reg_std_id;
            $term = subject_student::where('student_id',$user_id)->get();
            $term = subject::find($term[0]->subject_id);
            $name = new project();
            $name->name_th = $request['Project_name_thai'];
            $name->name_en = $request['Project_name_eg'];
            $name->status = "Waiting";
            $name->subject_id = $term->id;

            $term = subject::query()->where('id', 'LIKE', "%{$request['subject']}%")->get();

            $name->save();
            $id =  $name->id;
            $data_nameProject = project::find($id);
            
            $fileModel->name_file = time() . '_' . $request->File->getClientOriginalName();
            $fileModel->status_file_path = "Waiting";
            $fileModel->Project_id_File = $name->id;

            
            Storage::disk('local')->putFileAs(
                'Waiting/' . $term[0]->year_term,
                $request->File,
                $fileModel->name_file
            );
            $fileModel->save();
            $term = $request->user()->id;
            $term = reg_std::query()->where('user_id', 'LIKE', $term)->get();
            return view('/projects/list_name', compact("data_nameProject", "term", "name_Instructor"));
        } else {
            abort(404);
        }
    }
    
    public function test50(Request $request, $id)
    {
        $id_user = Auth::user()->id;
        $user = $request->user();
        $name_Instructor = Teacher::pluck('name_Instructor', 'id');
        if ($user->hasRole('Admin')) {
            $datas_instructor = DB::table('projects')
                ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_users', 'projects.id', '=', 'project_users.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $id]])->get();
            return view('/word-template/test50', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        }
        if ($id_user == $id) {
            $user = $request->user()->id;
            $data_std_reg = DB::table('reg_stds')->where('user_id', $user)->select('reg_stds.id')->get();
            $data_std = DB::table('project_users')->where('id_reg_Std', $data_std_reg[0]->id)->select('project_users.*')->get();

            $datas_instructor = DB::table('projects')
                ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $data_std[0]->Project_id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_users', 'projects.id', '=', 'project_users.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();
            return view('/word-template/test50', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        } else {
            abort(404);
        }
    }
    public function ChangeBoard(Request $request, $id){
        $id_user = Auth::user()->id;
        $user = $request->user();
        $name_Instructor = Teacher::pluck('name_Instructor', 'id');
        if ($user->hasRole('Admin')) {
            $datas_instructor = DB::table('projects')
                ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_users', 'projects.id', '=', 'project_users.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $id]])->get();
            return view('/word-template/ChangeBoard', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        }
        if ($id_user == $id) {
            $user = $request->user()->id;
            $data_std_reg = DB::table('reg_stds')->where('user_id', $user)->select('reg_stds.id')->get();
            $data_std = DB::table('project_users')->where('id_reg_Std', $data_std_reg[0]->id)->select('project_users.*')->get();

            $datas_instructor = DB::table('projects')
                ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $data_std[0]->Project_id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_users', 'projects.id', '=', 'project_users.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();
            return view('/word-template/ChangeBoard', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        } else {
            abort(404);
        }
    }
    public function ChangeTopic(Request $request, $id){
        $id_user = Auth::user()->id;
        $user = $request->user();
        $name_Instructor = Teacher::pluck('name_Instructor', 'id');
        if ($user->hasRole('Admin')) {
            $datas_instructor = DB::table('projects')
                ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_users', 'projects.id', '=', 'project_users.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $id]])->get();
            return view('/word-template/ChangeTopic', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        }
        if ($id_user == $id) {
            $user = $request->user()->id;
            $data_std_reg = DB::table('reg_stds')->where('user_id', $user)->select('reg_stds.id')->get();
            $data_std = DB::table('project_users')->where('id_reg_Std', $data_std_reg[0]->id)->select('project_users.*')->get();

            $datas_instructor = DB::table('projects')
                ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $data_std[0]->Project_id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_users', 'projects.id', '=', 'project_users.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();
            return view('/word-template/ChangeTopic', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        } else {
            abort(404);
        }
    }
    public function wordExport_ChangeTopic(Request $request ,$id){
        $request->validate([
            'note' => 'required',
            'new_project_name_thai'=> 'required',
            'new_project_name_eg'=>'required'
        ]);
        $ChangeTopic_DB = ChangeTopic::create([
            'Project_id_changetopics'=>$id,
            'old_name_th' => $request->Project_name_thai,
            'old_name_en' =>$request->Project_name_eg,
            'new_name_th'=>$request->new_project_name_thai,
            'new_name_en'=>$request->new_project_name_eg,
            'note'=>$request->note,
            'status_changetopics'=>'Waiting'
        ]);
       
        $Project_id = DB::table('project_instructors')->where('Project_id',$id)->get();
        $user_noti1 = User::where('reg_tea_id',$Project_id[0]->id_instructor)->get();
        $user_noti2 = User::where('reg_tea_id',$Project_id[1]->id_instructor)->get();
        $user_noti3 = User::where('reg_tea_id',$Project_id[2]->id_instructor)->get();

       $id_ChangeTopicDB = changetopic::find($ChangeTopic_DB->id);

        $this->notifications_fun($user_noti1[0]->id,7,$id_ChangeTopicDB->id,'ขออนุญาตเปลี่ยนแปลงหัวข้อโครงงานคอมพิวเตอร์');
        $this->notifications_fun($user_noti2[0]->id,7,$id_ChangeTopicDB->id,'ขออนุญาตเปลี่ยนแปลงหัวข้อโครงงานคอมพิวเตอร์');
        $this->notifications_fun($user_noti3[0]->id,7,$id_ChangeTopicDB->id,'ขออนุญาตเปลี่ยนแปลงหัวข้อโครงงานคอมพิวเตอร์');
        $this->notifications_fun(1,7,$id_ChangeTopicDB->id,'ขออนุญาตเปลี่ยนแปลงหัวข้อโครงงานคอมพิวเตอร์');

        $templateProcessor = new TemplateProcessor(storage_path('word-template/08-คำร้องทั่วไป-ขออนุญาตเปลี่ยนแปลงหัวข้อโครงงานคอมพิวเตอร์.docx'));
        $templateProcessor->setValue('id', $request->reg_std1);
        $templateProcessor->setValue('name', $request->reg_std1_name);
        $templateProcessor->setValue('phone', $request->reg_std1_Phone);

        if (!empty($request->reg_std2)) {
            $templateProcessor->setValue('id2', $request->reg_std2);
            $templateProcessor->setValue('name2', $request->reg_std2_name);
            $templateProcessor->setValue('phone2', $request->reg_std2_Phone);
            $templateProcessor->setValue('code2', "รหัส ");
            $templateProcessor->setValue('phone_n2', "มือถือ ");
            $templateProcessor->setValue('and_name2',"และ ");
        } else {
            $templateProcessor->setValue('code2', "");
            $templateProcessor->setValue('phone_n2', "");
            $templateProcessor->setValue('id2',"" );
            $templateProcessor->setValue('name2',"" );
            $templateProcessor->setValue('phone2', "");
            $templateProcessor->setValue('and_name2'," ");
        }


        if (!empty($request->reg_std3)) {
            $templateProcessor->setValue('id3', $request->reg_std3);
            $templateProcessor->setValue('name3', $request->reg_std3_name);
            $templateProcessor->setValue('phone3', $request->reg_std3_Phone);
            $templateProcessor->setValue('code3', "รหัส ");
            $templateProcessor->setValue('phone_n3', "มือถือ ");
            $templateProcessor->setValue('and_name3',"และ ");
        } else {
            $templateProcessor->setValue('id3', "");
            $templateProcessor->setValue('name3', "");
            $templateProcessor->setValue('phone3', "");
            $templateProcessor->setValue('code3', "");
            $templateProcessor->setValue('phone_n3', "");
            $templateProcessor->setValue('and_name3'," ");
        }
        $templateProcessor->setValue('name_president', $request->name_president);
        $templateProcessor->setValue('name_director1', $request->name_director1);
        $templateProcessor->setValue('name_director2', $request->name_director2);

        $templateProcessor->setValue('name_Thai', $request->Project_name_thai);
        $templateProcessor->setValue('name_Eng', $request->Project_name_eg);

        $templateProcessor->setValue('new_name_Thai', $request->new_project_name_thai);
        $templateProcessor->setValue('new_name_Eng', $request->new_project_name_eg);
    
        $templateProcessor->setValue('note', $request->note);
        $templateProcessor->setValue('date_now', formatDateThai(date("Y-m-d")));

        $fileName = storage_path("ขออนุญาตเปลี่ยนแปลงหัวข้อโครงงานคอมพิวเตอร์". '.docx');
        $templateProcessor->saveAs($fileName );

        return response()->download($fileName )->deleteFileAfterSend(true);
    }
    public function CompleteForm(Request $request, $id){
        $id_user = Auth::user()->id;
        $user = $request->user();
        $name_Instructor = Teacher::pluck('name_Instructor', 'id');
        if ($user->hasRole('Admin')) {
            $datas_instructor = DB::table('projects')
                ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_users', 'projects.id', '=', 'project_users.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $id]])->get();
            return view('/word-template/CompleteForm', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        }
        if ($id_user == $id) {
            $user = $request->user()->id;
            $data_std_reg = DB::table('reg_stds')->where('user_id', $user)->select('reg_stds.id')->get();
            $data_std = DB::table('project_users')->where('id_reg_Std', $data_std_reg[0]->id)->select('project_users.*')->get();

            $datas_instructor = DB::table('projects')
                ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $data_std[0]->Project_id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_users', 'projects.id', '=', 'project_users.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();
            return view('/word-template/CompleteForm', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        } else {
            abort(404);
        }
    }
    public function test100(Request $request, $id){
        $id_user = Auth::user()->id;
        $user = $request->user();
        $name_Instructor = Teacher::pluck('name_Instructor', 'id');
        if ($user->hasRole('Admin')) {
            $datas_instructor = DB::table('projects')
                ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_users', 'projects.id', '=', 'project_users.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $id]])->get();
            return view('/word-template/test100', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        }
        if ($id_user == $id) {
            $user = $request->user()->id;
            $data_std_reg = DB::table('reg_stds')->where('user_id', $user)->select('reg_stds.id')->get();
            $data_std = DB::table('project_users')->where('id_reg_Std', $data_std_reg[0]->id)->select('project_users.*')->get();

            $datas_instructor = DB::table('projects')
                ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $data_std[0]->Project_id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_users', 'projects.id', '=', 'project_users.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();
            return view('/word-template/test100', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        } else {
            abort(404);
        }
    }
    public function wordExport_CompleteForm(Request $request, $id){
        
        
        //Database
        $CompleteForm_DB = CompleteForm::create([
                'Project_id_CompleteForm'=>$id,
                'status_CompleteForm'=>'Waiting'
            ]);
           
            $Project_id = DB::table('project_instructors')->where('Project_id',$id)->get();
           $id_CompleteFormDB = test50::find($CompleteForm_DB->id);           
            $this->notifications_fun(1,5,$id_CompleteFormDB->id,'แบบขอส่งโครงงานฉบับสมบูรณ์');

        $templateProcessor = new TemplateProcessor(storage_path('word-template/05-แบบขอส่งโครงงานฉบับสมบูรณ์.docx'));
        $templateProcessor->setValue('id', $request->reg_std1);
        $templateProcessor->setValue('name', $request->reg_std1_name);
        $templateProcessor->setValue('phone', $request->reg_std1_Phone);

        if (!empty($request->reg_std2)) {
            $templateProcessor->setValue('id2', $request->reg_std2);
            $templateProcessor->setValue('name2', $request->reg_std2_name);
            $templateProcessor->setValue('phone2', $request->reg_std2_Phone);
            $templateProcessor->setValue('code2', "รหัส ");
            $templateProcessor->setValue('phone_n2', "มือถือ ");
        } else {
            $templateProcessor->setValue('code2', "");
            $templateProcessor->setValue('phone_n2', "");
            $templateProcessor->setValue('id2',"" );
            $templateProcessor->setValue('name2',"" );
            $templateProcessor->setValue('phone2', "");
        }


        if (!empty($request->reg_std3)) {
            $templateProcessor->setValue('id3', $request->reg_std3);
            $templateProcessor->setValue('name3', $request->reg_std3_name);
            $templateProcessor->setValue('phone3', $request->reg_std3_Phone);
            $templateProcessor->setValue('code3', "รหัส ");
            $templateProcessor->setValue('phone_n3', "มือถือ ");
        } else {
            $templateProcessor->setValue('id3', "");
            $templateProcessor->setValue('name3', "");
            $templateProcessor->setValue('phone3', "");
            $templateProcessor->setValue('code3', "");
            $templateProcessor->setValue('phone_n3', "");
        }
        $templateProcessor->setValue('name_president', $request->name_president);
        $templateProcessor->setValue('name_director1', $request->name_director1);
        $templateProcessor->setValue('name_director2', $request->name_director2);

        $templateProcessor->setValue('name_Thai', $request->Project_name_thai);
        $templateProcessor->setValue('name_Eng', $request->Project_name_eg);
        $templateProcessor->setValue('date_now', formatDateThai(date("Y-m-d")));

        $fileName = storage_path("แบบขอส่งโครงงานฉบับสมบูรณ์". '.docx');
        $templateProcessor->saveAs($fileName);

        return response()->download($fileName )->deleteFileAfterSend(true);
    }
    public function wordExport_test50(Request $request ,$id)
    {

        $request->validate([
            'room_test50' => 'required',
            'File' => 'required|file|mimes:zip',
        ]);
        $name_file =time() . '_' . $request->File->getClientOriginalName();
        //Database
        $test50_DB = test50::create([
                'Project_id_test50'=>$id,
                'date_test50' => $request->date_test50,
                'end_date_test50' =>formatDateEnd_test($request->date_test50),
                'room_test50'=> $request->room_test50,
                'file_test50'=>time() . '_' . $request->File->getClientOriginalName(),
                'status_test50'=>'Waiting'
            ]);
            Storage::disk('local')->putFileAs(
                'test50/Waiting',
                $request->File,
                $name_file
            );
            $Project_id = DB::table('project_instructors')->where('Project_id',$id)->get();
            $user_noti1 = User::where('reg_tea_id',$Project_id[0]->id_instructor)->get();
            $user_noti2 = User::where('reg_tea_id',$Project_id[1]->id_instructor)->get();
            $user_noti3 = User::where('reg_tea_id',$Project_id[2]->id_instructor)->get();
           $id_test50DB = test50::find($test50_DB->id);
            $this->notifications_fun($user_noti1[0]->id,1,$id_test50DB->id,'แบบเสนอขอสอบ50');
            $this->notifications_fun($user_noti2[0]->id,1,$id_test50DB->id,'แบบเสนอขอสอบ50');
            $this->notifications_fun($user_noti3[0]->id,1,$id_test50DB->id,'แบบเสนอขอสอบ50');
            $this->notifications_fun(1,1,$id_test50DB->id,'แบบเสนอขอสอบ50');
            // return response()->json($user_noti1[0]->id);

        //wordExport
        $templateProcessor = new TemplateProcessor(storage_path('word-template/02-แบบเสนอขอสอบ50.docx'));
        $templateProcessor->setValue('id', $request->reg_std1);
        $templateProcessor->setValue('name', $request->reg_std1_name);
        $templateProcessor->setValue('phone', $request->reg_std1_Phone);

        if (!empty($request->reg_std2)) {
            $templateProcessor->setValue('id2', $request->reg_std2);
            $templateProcessor->setValue('name2', $request->reg_std2_name);
            $templateProcessor->setValue('phone2', $request->reg_std2_Phone);
            $templateProcessor->setValue('code2', "รหัส ");
            $templateProcessor->setValue('phone_n2', "มือถือ ");
        } else {
            $templateProcessor->setValue('code2', "");
            $templateProcessor->setValue('phone_n2', "");
            $templateProcessor->setValue('id2',"" );
            $templateProcessor->setValue('name2',"" );
            $templateProcessor->setValue('phone2', "");
        }


        if (!empty($request->reg_std3)) {
            $templateProcessor->setValue('id3', $request->reg_std3);
            $templateProcessor->setValue('name3', $request->reg_std3_name);
            $templateProcessor->setValue('phone3', $request->reg_std3_Phone);
            $templateProcessor->setValue('code3', "รหัส ");
            $templateProcessor->setValue('phone_n3', "มือถือ ");
        } else {
            $templateProcessor->setValue('id3', "");
            $templateProcessor->setValue('name3', "");
            $templateProcessor->setValue('phone3', "");
            $templateProcessor->setValue('code3', "");
            $templateProcessor->setValue('phone_n3', "");
        }
        $templateProcessor->setValue('name_president', $request->name_president);
        $templateProcessor->setValue('name_director1', $request->name_director1);
        $templateProcessor->setValue('name_director2', $request->name_director2);

        $templateProcessor->setValue('name_Thai', $request->Project_name_thai);
        $templateProcessor->setValue('name_Eng', $request->Project_name_eg);

        $templateProcessor->setValue('date', formatDateThai($request->date_test50));
        $templateProcessor->setValue('time', formatDateThai_time($request->date_test50));
        $templateProcessor->setValue('room', $request->room_test50);
        $templateProcessor->setValue('end_time',formatDateThai_End_time($request->date_test50));
        $templateProcessor->setValue('date_now', formatDateThai(date("Y-m-d")));

        $fileName = storage_path("แบบเสนอขอสอบ50". '.docx');
        $templateProcessor->saveAs($fileName);

        return response()->download($fileName )->deleteFileAfterSend(true);
    }
    public function wordExport_ChangeBoard(Request $request,$id){
        $request->validate([
            'note' => 'required',
        ]);
        $ChangeBoard_DB = ChangeBoard::create([
            'Project_id_ChangeBoard'=>$id,
            'old_name_president'=>$request->name_president,
            'old_name_director1'=>$request->name_director1,
            'old_name_director2'=>$request->name_director2,
            'new_name_president'=>$request->new_name_president,
            'new_name_director1'=>$request->new_name_director1,
            'new_name_director2'=>$request->new_name_director2,
            'note'=>$request->note,
            'status_ChangeBoard'=>'Waiting'
        ]);
       
        $Project_id = DB::table('project_instructors')->where('Project_id',$id)->get();
        $user_noti1 = User::where('reg_tea_id',$Project_id[0]->id_instructor)->get();
        $user_noti2 = User::where('reg_tea_id',$Project_id[1]->id_instructor)->get();
        $user_noti3 = User::where('reg_tea_id',$Project_id[2]->id_instructor)->get();

        $new_user_noti1 = User::where('reg_tea_id',$request->new_name_president)->get();
        $new_user_noti2 = User::where('reg_tea_id',$request->new_name_director1)->get();
        $new_user_noti3 = User::where('reg_tea_id',$request->new_name_director2)->get();

       $id_ChangeBoardDB = ChangeBoard::find($ChangeBoard_DB->id);
        $this->notifications_fun($user_noti1[0]->id,6,$id_ChangeBoardDB->id,'ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์');
        $this->notifications_fun($user_noti2[0]->id,6,$id_ChangeBoardDB->id,'ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์');
        $this->notifications_fun($user_noti3[0]->id,6,$id_ChangeBoardDB->id,'ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์');

        switch($new_user_noti1[0]->id){
            case($user_noti1[0]->id):break;
            case($user_noti2[0]->id):break;
            case($user_noti3[0]->id):break;
            default: $this->notifications_fun($new_user_noti1[0]->id,6,$id_ChangeBoardDB->id,'ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์');
            break;
        }
        switch($new_user_noti2[0]->id){
            case($user_noti1[0]->id):break;
            case($user_noti2[0]->id):break;
            case($user_noti3[0]->id):break;
            default:$this->notifications_fun($new_user_noti2[0]->id,6,$id_ChangeBoardDB->id,'ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์');break;
        }
        switch($new_user_noti3[0]->id){
            default:$this->notifications_fun($new_user_noti3[0]->id,6,$id_ChangeBoardDB->id,'ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์');break;
            case($user_noti1[0]->id):break;
            case($user_noti2[0]->id):break;
            case($user_noti3[0]->id):break;
        }
        
            // return response()->json($new_user_noti1[0]->id);
        $this->notifications_fun(1,6,$id_ChangeBoardDB->id,'ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์');

        $templateProcessor = new TemplateProcessor(storage_path('word-template/07-คำร้องทั่วไป-ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์.docx'));
        $templateProcessor->setValue('id', $request->reg_std1);
        $templateProcessor->setValue('name', $request->reg_std1_name);
        $templateProcessor->setValue('phone', $request->reg_std1_Phone);

        if (!empty($request->reg_std2)) {
            $templateProcessor->setValue('id2', $request->reg_std2);
            $templateProcessor->setValue('name2', $request->reg_std2_name);
            $templateProcessor->setValue('phone2', $request->reg_std2_Phone);
            $templateProcessor->setValue('code2', "รหัส ");
            $templateProcessor->setValue('phone_n2', "มือถือ ");
            $templateProcessor->setValue('and_name2',"และ ");
        } else {
            $templateProcessor->setValue('code2', "");
            $templateProcessor->setValue('phone_n2', "");
            $templateProcessor->setValue('id2',"" );
            $templateProcessor->setValue('name2',"" );
            $templateProcessor->setValue('phone2', "");
            $templateProcessor->setValue('and_name2'," ");
        }


        if (!empty($request->reg_std3)) {
            $templateProcessor->setValue('id3', $request->reg_std3);
            $templateProcessor->setValue('name3', $request->reg_std3_name);
            $templateProcessor->setValue('phone3', $request->reg_std3_Phone);
            $templateProcessor->setValue('code3', "รหัส ");
            $templateProcessor->setValue('phone_n3', "มือถือ ");
            $templateProcessor->setValue('and_name3',"และ ");
        } else {
            $templateProcessor->setValue('id3', "");
            $templateProcessor->setValue('name3', "");
            $templateProcessor->setValue('phone3', "");
            $templateProcessor->setValue('code3', "");
            $templateProcessor->setValue('phone_n3', "");
            $templateProcessor->setValue('and_name3'," ");
        }
        $templateProcessor->setValue('name_president', $request->name_president);
        $templateProcessor->setValue('name_director1', $request->name_director1);
        $templateProcessor->setValue('name_director2', $request->name_director2);

        $templateProcessor->setValue('name_Thai', $request->Project_name_thai);
        $templateProcessor->setValue('name_Eng', $request->Project_name_eg);

        $new_name_president = $request->get('new_name_president');
        $new_name_president = Teacher::query()->where('id', 'LIKE', "%{$new_name_president}%")->get();
        $new_name_director1 = $request->get('new_name_director1');
        $new_name_director1 = Teacher::query()->where('id', 'LIKE', "%{$new_name_director1}%")->get();
        $new_name_director2 = $request->get('new_name_director2');
        $new_name_director2 = Teacher::query()->where('id', 'LIKE', "%{$new_name_director2}%")->get();

        $templateProcessor->setValue('new_name_president', $new_name_president[0]->Title_name_Instructor.$new_name_president[0]->name_Instructor);
        $templateProcessor->setValue('new_name_director1', $new_name_director1[0]->Title_name_Instructor.$new_name_director1[0]->name_Instructor);
        $templateProcessor->setValue('new_name_director2', $new_name_director2[0]->Title_name_Instructor.$new_name_director2[0]->name_Instructor);
        $templateProcessor->setValue('note', $request->note);
        $templateProcessor->setValue('date_now', formatDateThai(date("Y-m-d")));

        $fileName = storage_path("ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์". '.docx');
        $templateProcessor->saveAs($fileName );

        return response()->download($fileName)->deleteFileAfterSend(true);
    }
    public function wordExport_test100(Request $request,$id)
    {
        $request->validate([
            'room_test100' => 'required',
            'File' => 'required|file|mimes:zip',
        ]);
        $name_file = time() . '_' . $request->File->getClientOriginalName();
        //Database
        $test100_DB = test100::create([
                'Project_id_test100'=>$id,
                'date_test100' => $request->date_test100,
                'end_date_test100' =>formatDateEnd_test($request->date_test100),
                'room_test100'=> $request->room_test100,
                'file_test100'=>$name_file,
                'status_test100'=>'Waiting'
            ]);
            Storage::disk('local')->putFileAs(
                'test100/Waiting',
                $request->File,
                $name_file
            );
            $Project_id = DB::table('project_instructors')->where('Project_id',$id)->get();
            $user_noti1 = User::where('reg_tea_id',$Project_id[0]->id_instructor)->get();
            $user_noti2 = User::where('reg_tea_id',$Project_id[1]->id_instructor)->get();
            $user_noti3 = User::where('reg_tea_id',$Project_id[2]->id_instructor)->get();
           $id_test100DB = test100::find($test100_DB->id);
            $this->notifications_fun($user_noti1[0]->id,3,$id_test100DB->id,'แบบเสนอขอสอบ100');
            $this->notifications_fun($user_noti2[0]->id,3,$id_test100DB->id,'แบบเสนอขอสอบ100');
            $this->notifications_fun($user_noti3[0]->id,3,$id_test100DB->id,'แบบเสนอขอสอบ100');
            $this->notifications_fun(1,3,$id_test100DB->id,'แบบเสนอขอสอบ100');
        $templateProcessor = new TemplateProcessor(storage_path('word-template/04-แบบเสนอขอสอบ100.docx'));
        $templateProcessor->setValue('id', $request->reg_std1);
        $templateProcessor->setValue('name', $request->reg_std1_name);
        $templateProcessor->setValue('phone', $request->reg_std1_Phone);

        if (!empty($request->reg_std2)) {
            $templateProcessor->setValue('id2', $request->reg_std2);
            $templateProcessor->setValue('name2', $request->reg_std2_name);
            $templateProcessor->setValue('phone2', $request->reg_std2_Phone);
            $templateProcessor->setValue('code2', "รหัส ");
            $templateProcessor->setValue('phone_n2', "มือถือ ");
        } else {
            $templateProcessor->setValue('code2', "");
            $templateProcessor->setValue('phone_n2', "");
            $templateProcessor->setValue('id2',"" );
            $templateProcessor->setValue('name2',"" );
            $templateProcessor->setValue('phone2', "");
        }


        if (!empty($request->reg_std3)) {
            $templateProcessor->setValue('id3', $request->reg_std3);
            $templateProcessor->setValue('name3', $request->reg_std3_name);
            $templateProcessor->setValue('phone3', $request->reg_std3_Phone);
            $templateProcessor->setValue('code3', "รหัส ");
            $templateProcessor->setValue('phone_n3', "มือถือ ");
        } else {
            $templateProcessor->setValue('id3', "");
            $templateProcessor->setValue('name3', "");
            $templateProcessor->setValue('phone3', "");
            $templateProcessor->setValue('code3', "");
            $templateProcessor->setValue('phone_n3', "");
        }
        $templateProcessor->setValue('name_president', $request->name_president);
        $templateProcessor->setValue('name_director1', $request->name_director1);
        $templateProcessor->setValue('name_director2', $request->name_director2);

        $templateProcessor->setValue('name_Thai', $request->Project_name_thai);
        $templateProcessor->setValue('name_Eng', $request->Project_name_eg);

        $templateProcessor->setValue('date', formatDateThai($request->date_test100));
        $templateProcessor->setValue('time', formatDateThai_time($request->date_test100));
        $templateProcessor->setValue('room', $request->room_test100);
        $templateProcessor->setValue('end_time',formatDateThai_End_time($request->date_test100));
        $templateProcessor->setValue('date_now', formatDateThai(date("Y-m-d")));

        $fileName = storage_path("แบบเสนอขอสอบ100". '.docx');
        $templateProcessor->saveAs($fileName );

        return response()->download($fileName )->deleteFileAfterSend(true);
    }
    public function ProgressReport_test50(Request $request, $id){
        $id_user = Auth::user()->id;
        $user = $request->user();
        $name_Instructor = Teacher::pluck('name_Instructor', 'id');
     
        if ($id_user == $id) {
            $user = $request->user()->id;
            $data_std_reg = DB::table('reg_stds')->where('user_id', $user)->select('reg_stds.id')->get();
            $data_std = DB::table('project_users')->where('id_reg_Std', $data_std_reg[0]->id)->select('project_users.*')->get();

            $datas_instructor = DB::table('projects')
                ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $data_std[0]->Project_id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_users', 'projects.id', '=', 'project_users.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();
            
            $time_test50 = test50::where('Project_id_test50',$datas[0]->id)->get();
            return view('/word-template/ProgressReport_test50', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor','time_test50'));
        } else {
            abort(404);
        }
    }
    public function wordExport_ProgressReport_test50(Request $request ,$id){

        
        
        //Database
        $ProgressReport_test50_DB = ProgressReport_test50::create([
                'Project_id_report_test50'=>$id,              
                'status_progress_report_test50'=>'Waiting'
            ]);
          
            $Project_id = DB::table('project_instructors')->where('Project_id',$id)->get();
            $user_noti1 = User::where('reg_tea_id',$Project_id[0]->id_instructor)->get();
            $user_noti2 = User::where('reg_tea_id',$Project_id[1]->id_instructor)->get();
            $user_noti3 = User::where('reg_tea_id',$Project_id[2]->id_instructor)->get();
           $id_ProgressReport_test50_DB = ProgressReport_test50::find($ProgressReport_test50_DB->id);
            $this->notifications_fun($user_noti1[0]->id,2,$id_ProgressReport_test50_DB->id,'รายงานการสอบความก้าวหน้าสอบ50');
            $this->notifications_fun($user_noti2[0]->id,2,$id_ProgressReport_test50_DB->id,'รายงานการสอบความก้าวหน้าสอบ50');
            $this->notifications_fun($user_noti3[0]->id,2,$id_ProgressReport_test50_DB->id,'รายงานการสอบความก้าวหน้าสอบ50');
            $this->notifications_fun(1,2,$id_ProgressReport_test50_DB->id,'รายงานการสอบความก้าวหน้าสอบ50');

        $templateProcessor = new TemplateProcessor(storage_path('word-template/03-รายงานการสอบความก้าวหน้า.docx'));
        $templateProcessor->setValue('id', $request->reg_std1);
        $templateProcessor->setValue('name', $request->reg_std1_name);
        $templateProcessor->setValue('phone', $request->reg_std1_Phone);

        if (!empty($request->reg_std2)) {
            $templateProcessor->setValue('id2', $request->reg_std2);
            $templateProcessor->setValue('name2', $request->reg_std2_name);
            $templateProcessor->setValue('phone2', $request->reg_std2_Phone);
            $templateProcessor->setValue('code2', "รหัส ");
            $templateProcessor->setValue('phone_n2', "มือถือ ");
            $templateProcessor->setValue('and_name2', "ชื่อนักศึกษา ");
        } else {
            $templateProcessor->setValue('code2', "");
            $templateProcessor->setValue('phone_n2', "");
            $templateProcessor->setValue('id2',"" );
            $templateProcessor->setValue('name2',"" );
            $templateProcessor->setValue('phone2', "");
            $templateProcessor->setValue('and_name2', "");
        }


        if (!empty($request->reg_std3)) {
            $templateProcessor->setValue('id3', $request->reg_std3);
            $templateProcessor->setValue('name3', $request->reg_std3_name);
            $templateProcessor->setValue('phone3', $request->reg_std3_Phone);
            $templateProcessor->setValue('code3', "รหัส ");
            $templateProcessor->setValue('phone_n3', "มือถือ ");
            $templateProcessor->setValue('and_name3', "ชื่อนักศึกษา ");
        } else {
            $templateProcessor->setValue('id3', "");
            $templateProcessor->setValue('name3', "");
            $templateProcessor->setValue('phone3', "");
            $templateProcessor->setValue('code3', "");
            $templateProcessor->setValue('phone_n3', "");
            $templateProcessor->setValue('and_name3', "");
        }
        $templateProcessor->setValue('name_president', $request->name_president);
        $templateProcessor->setValue('name_director1', $request->name_director1);
        $templateProcessor->setValue('name_director2', $request->name_director2);
        $templateProcessor->setValue('date_test',$request->date_test );

        $templateProcessor->setValue('name_Thai', $request->Project_name_thai);
        $templateProcessor->setValue('name_Eng', $request->Project_name_eg);
        $templateProcessor->setValue('date_now', formatDateThai(date("Y-m-d")));

        $fileName = storage_path("รายงานการสอบความก้าวหน้า50". '.docx');
        $templateProcessor->saveAs($fileName);

        return response()->download($fileName )->deleteFileAfterSend(true);
    }
    public function ProgressReport_test100(Request $request, $id){
        $id_user = Auth::user()->id;
        $user = $request->user();
        $name_Instructor = Teacher::pluck('name_Instructor', 'id');
      
        if ($id_user == $id) {
            $user = $request->user()->id;
            $data_std_reg = DB::table('reg_stds')->where('user_id', $user)->select('reg_stds.id')->get();
            $data_std = DB::table('project_users')->where('id_reg_Std', $data_std_reg[0]->id)->select('project_users.*')->get();

            $datas_instructor = DB::table('projects')
                ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $data_std[0]->Project_id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_users', 'projects.id', '=', 'project_users.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();
                $time_test100 = test100::where('Project_id_test100',$datas[0]->id)->get();
            return view('/word-template/ProgressReport_test100', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor','time_test100'));
        } else {
            abort(404);
        }
    }
    public function wordExport_ProgressReport_test100(Request $request, $id){
        //Database
        $ProgressReport_test50_DB = ProgressReport_test100::create([
            'Project_id_report_test100'=>$id,              
            'status_progress_report_test100'=>'Waiting'
        ]);
      
        $Project_id = DB::table('project_instructors')->where('Project_id',$id)->get();
        $user_noti1 = User::where('reg_tea_id',$Project_id[0]->id_instructor)->get();
        $user_noti2 = User::where('reg_tea_id',$Project_id[1]->id_instructor)->get();
        $user_noti3 = User::where('reg_tea_id',$Project_id[2]->id_instructor)->get();
       $id_ProgressReport_test100_DB = ProgressReport_test100::find($ProgressReport_test50_DB->id);
        $this->notifications_fun($user_noti1[0]->id,4,$id_ProgressReport_test100_DB->id,'รายงานการสอบความก้าวหน้าสอบ100');
        $this->notifications_fun($user_noti2[0]->id,4,$id_ProgressReport_test100_DB->id,'รายงานการสอบความก้าวหน้าสอบ100');
        $this->notifications_fun($user_noti3[0]->id,4,$id_ProgressReport_test100_DB->id,'รายงานการสอบความก้าวหน้าสอบ100');
        $this->notifications_fun(1,4,$id_ProgressReport_test100_DB->id,'รายงานการสอบความก้าวหน้าสอบ100');
        $templateProcessor = new TemplateProcessor(storage_path('word-template/03-รายงานการสอบความก้าวหน้า.docx'));
        $templateProcessor->setValue('id', $request->reg_std1);
        $templateProcessor->setValue('name', $request->reg_std1_name);
        $templateProcessor->setValue('phone', $request->reg_std1_Phone);

        if (!empty($request->reg_std2)) {
            $templateProcessor->setValue('id2', $request->reg_std2);
            $templateProcessor->setValue('name2', $request->reg_std2_name);
            $templateProcessor->setValue('phone2', $request->reg_std2_Phone);
            $templateProcessor->setValue('code2', "รหัส ");
            $templateProcessor->setValue('phone_n2', "มือถือ ");
            $templateProcessor->setValue('and_name2', "ชื่อนักศึกษา ");
        } else {
            $templateProcessor->setValue('code2', "");
            $templateProcessor->setValue('phone_n2', "");
            $templateProcessor->setValue('id2',"" );
            $templateProcessor->setValue('name2',"" );
            $templateProcessor->setValue('phone2', "");
            $templateProcessor->setValue('and_name2', "");
        }


        if (!empty($request->reg_std3)) {
            $templateProcessor->setValue('id3', $request->reg_std3);
            $templateProcessor->setValue('name3', $request->reg_std3_name);
            $templateProcessor->setValue('phone3', $request->reg_std3_Phone);
            $templateProcessor->setValue('code3', "รหัส ");
            $templateProcessor->setValue('phone_n3', "มือถือ ");
            $templateProcessor->setValue('and_name3', "ชื่อนักศึกษา ");
        } else {
            $templateProcessor->setValue('id3', "");
            $templateProcessor->setValue('name3', "");
            $templateProcessor->setValue('phone3', "");
            $templateProcessor->setValue('code3', "");
            $templateProcessor->setValue('phone_n3', "");
            $templateProcessor->setValue('and_name3', "");
        }
        $templateProcessor->setValue('name_president', $request->name_president);
        $templateProcessor->setValue('name_director1', $request->name_director1);
        $templateProcessor->setValue('name_director2', $request->name_director2);
        $templateProcessor->setValue('date_test',$request->date_test );

        $templateProcessor->setValue('name_Thai', $request->Project_name_thai);
        $templateProcessor->setValue('name_Eng', $request->Project_name_eg);
        $templateProcessor->setValue('date_now', formatDateThai(date("Y-m-d")));

        $fileName = storage_path("รายงานการสอบความก้าวหน้า". '.docx');
        $templateProcessor->saveAs($fileName );

        return response()->download($fileName )->deleteFileAfterSend(true);
    }
    public function notifications_fun($id_Instructor,$form,$form_id,$Title_form){
        $sendToUser  = User::find($id_Instructor);
        $sendToUser->notify(new InvoicePaid($form ,$form_id,$Title_form,Auth::user()));
        // Notification::send($id_Instructor ,new InvoicePaid($form ,$form_id));
    }
    public function edit_project(Request $request,$id){
        
        if (Auth::user()->hasRole('Admin')) {
        $project_id = project::find($id);
        $project_id->name_th = $request->Project_name_thai;
         $project_id->name_en = $request->Project_name_eg;
         $project_id->save();
        $id_stu_project = project_user::query()->where('Project_id',$id)->get();
        if($request->reg_std1 != 0){
            $id_reg1 = reg_std::where('std_code',$request->reg_std1)->get();
                $id_stu_project[0]->id_reg_Std = $id_reg1[0]->id;
                $id_stu_project[0]->save();
        }
        if($request->reg_std2 != 0){
            $id_reg2 = reg_std::where('std_code',$request->reg_std2)->get();
            $id_stu_project[1]->id_reg_Std = $id_reg2[0]->id;
                $id_stu_project[1]->save();
        }
        if($request->reg_std3 != 0){
            $id_reg3 = reg_std::where('std_code',$request->reg_std3)->get();
                $id_stu_project[2]->id_reg_Std = $id_reg3[0]->id;
                $id_stu_project[2]->save();
            }

        // $id_reg1 = reg_std::where('std_code',$request->reg_std1)->get();
        // $id_reg2 = reg_std::where('std_code',$request->reg_std2)->get();
        // $id_reg3 = reg_std::where('std_code',$request->reg_std3)->get();

        // if($id_reg1[0]->id != 0){
        //     $id_stu_project[0]->id_reg_Std = $id_reg1[0]->id;
        //     $id_stu_project[0]->save();
        // }if($id_reg2[0]->id != 0){
        //     $id_stu_project[1]->id_reg_Std = $id_reg2[0]->id;
        //     $id_stu_project[1]->save();
        // }if($id_reg3[0]->id != 0){
        //     $id_stu_project[2]->id_reg_Std = $id_reg3[0]->id;
        //     $id_stu_project[2]->save();
        // }
        // $id_stu_project[0]->id_reg_Std = $id_reg1[0]->id;
        // $id_stu_project[1]->id_reg_Std = $id_reg2[0]->id;
        // $id_stu_project[2]->id_reg_Std = $id_reg3[0]->id;
        // $id_stu_project[0]->save();
        // $id_stu_project[1]->save();
        // $id_stu_project[2]->save();

        $name_president = project_instructor::where('Project_id',$id)->get();

        if($request->name_president != 0){
            $name_president[0]->id_instructor = $request->name_president;
            $name_president[0]->save();
        }if($request->name_director1 != 0){
            $name_president[1]->id_instructor = $request->name_director1;
            $name_president[1]->save();
        }if($request->name_director2 != 0){
            $name_president[2]->id_instructor = $request->name_director2;
            $name_president[2]->save();
        }
        $datas = project::orderBy('id', 'ASC')->paginate(10);
        
       
        return view('projects.projects', compact('datas'));
    }
    if (Auth::user()->hasRole('Std')) {
        $request->validate([
            'File' => 'required|file|mimes:zip',

        ]);
        $project_id = project::find($id);
        $project_id->name_th = $request->Project_name_thai;
         $project_id->name_en = $request->Project_name_eg;
         $project_id->status = 'Waiting';
         $project_id->save();
         $fileModel = Project_File::find(["Project_id_File",$id]);
         $fileModel[0]->name_file = time() . '_' . $request->File->getClientOriginalName();
         $fileModel[0]->status_file_path = "Waiting";
         $subject = subject::find($project_id->subject_id);
        //  return response()->json($project_id);
         Storage::disk('local')->putFileAs(
            'Waiting/' . $subject->year_term,
            $request->File,
            $fileModel[0]->name_file
        );

         $fileModel[0]->save();
       
        $id_stu_project = project_user::query()->where('Project_id',$id)->get();
        if($request->reg_std1 != 0){
            $id_reg1 = reg_std::where('std_code',$request->reg_std1)->get();
                $id_stu_project[0]->id_reg_Std = $id_reg1[0]->id;
                $id_stu_project[0]->save();
        }
        if($request->reg_std2 != 0){
            $id_reg2 = reg_std::where('std_code',$request->reg_std2)->get();
            $id_stu_project[1]->id_reg_Std = $id_reg2[0]->id;
                $id_stu_project[1]->save();
        }
        if($request->reg_std3 != 0){
            $id_reg3 = reg_std::where('std_code',$request->reg_std3)->get();
                $id_stu_project[2]->id_reg_Std = $id_reg3[0]->id;
                $id_stu_project[2]->save();
            }
        $name_president = project_instructor::where('Project_id',$id)->get();

        if($request->name_president != 0){
            $name_president[0]->id_instructor = $request->name_president;
            $name_president[0]->save();
        }if($request->name_director1 != 0){
            $name_president[1]->id_instructor = $request->name_director1;
            $name_president[1]->save();
        }if($request->name_director2 != 0){
            $name_president[2]->id_instructor = $request->name_director2;
            $name_president[2]->save();
        }
            $user = $request->user()->id;
            $data_std1 = DB::table('reg_stds')->where('user_id', $user)->select('reg_stds.id')->get();
            $data_std = DB::table('project_users')->where('id_reg_Std', $data_std1[0]->id)->select('project_users.*')->get();
            if (!empty($data_std[0]->id)) {
                $status = DB::table('projects')->where('id', '=', $data_std[0]->Project_id)->select('projects.status')->get();
                $datas = project::orderBy('id', 'ASC')->paginate(10);
                if ($status[0]->status == "reject") {
                    return view('projects.projects', compact('datas', 'data_std', 'status'));
                } elseif ($status[0]->status == "Waiting") {
                    return view('projects.projects', compact('datas', 'data_std', 'status'));
                } elseif ($status[0]->status == "Check") {
                    return view('projects.projects', compact('datas', 'data_std', 'status'));
                } else {
                    $status = null;
                    return view('projects.projects', compact('datas', 'data_std', 'status'));
                }
            } else {
                $data_std = null;
                $status = null;
                $datas = project::orderBy('id', 'ASC')->paginate(10);
                return view('projects.projects', compact('datas', 'data_std', 'status'));
            }
      
        
        
    }
    }
    public function info_project($id){
        $mydata = User::find($id);
        $data_reg1 = reg_std::where('user_id',$mydata->id)->get();
        $id_stu_project = project_user::query()->where('id_reg_Std',$data_reg1[0]->id)->get();
    //     $name_president = project_instructor::where('Project_id',$id_stu_project[0]->Project_id)->get();
        
    //     $id_stu = project_user::query()->where('Project_id',$id_stu_project[0]->Project_id)->get();
    //     $data_reg2  = reg_std::where('id',$id_stu[1]->id_reg_Std)->get();
    //     $data_reg3  = reg_std::where('id',$id_stu[2]->id_reg_Std)->get();


    //    $tea_1= Teacher::find($name_president[0]->id_instructor);
    //    $tea_2= Teacher::find($name_president[1]->id_instructor);
    //    $tea_3= Teacher::find($name_president[2]->id_instructor);

    //    return response()->json($mydata);
        // return response()->json([$id_stu_project,$data_reg1,$data_reg2,$data_reg3]);
        // return response()->json([$tea_1,$tea_2,$tea_3 ]);
        // return view('projects.info_Project.index', compact('id_stu_project','data_reg1','data_reg2','data_reg3','tea_1','tea_2','tea_3' ));





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
                return view('projects.info_project', compact('datas', 'datas_std', 'datas_instructor'));
            } else {
                $datas_std = DB::table('projects')
                    ->join('project_users', 'projects.id', '=', 'project_users.Project_id')
                    ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                    ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
                    ->join('subjects', 'projects.subject_id', '=', 'subjects.id')
                    ->select('projects.*', 'project_users.*', 'reg_stds.*', 'project__files.*', 'subjects.*')->where([['projects.id', '=', $id_stu_project[0]->Project_id], ['project__files.status_file_path', '=', 'Waiting']])->get();
                return view('projects.info_project', compact('datas_std', 'datas'));
            }
    }
}
