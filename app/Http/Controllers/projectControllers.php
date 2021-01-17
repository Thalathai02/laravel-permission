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
use App\test50;
use App\test100;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\TemplateProcessor;

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
            $datas = project::all();
            return view('projects.projects', compact('datas'));
        }
        if ($user->hasRole('Tea')) {
            $datas = project::all();

            return view('projects.projects', compact('datas'));
        }
        if ($user->hasRole('Std')) {
            $user = $request->user()->id;
            $data_std1 = DB::table('reg_stds')->where('user_id', $user)->select('reg_stds.id')->get();
            $data_std = DB::table('project_user')->where('id_reg_Std', $data_std1[0]->id)->select('project_user.*')->get();
            if (!empty($data_std[0]->id)) {
                $status = DB::table('projects')->where('id', '=', $data_std[0]->Project_id)->select('projects.status')->get();
                $datas = project::all();
                if ($status[0]->status == "reject") {
                    return view('projects.projects', compact('datas', 'data_std', 'status'));
                } elseif ($status[0]->status == "not Check") {
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
                $datas = project::all();
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
    public function edit(Request $request, $id)
    {
        $id_user = Auth::user()->id;
        $user = $request->user();
        $name_Instructor = Teacher::pluck('name_Instructor', 'id');
        if ($user->hasRole('Admin')) {
            $datas_instructor = DB::table('projects')
                ->join('project_instructor', 'projects.id', '=', 'project_instructor.Project_id')
                ->join('teachers', 'project_instructor.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $id]])->get();
            return view('projects.Edit_Project.index', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        }
        if ($id_user == $id) {
            $user = $request->user()->id;
            $data_std_reg = DB::table('reg_stds')->where('user_id', $user)->select('reg_stds.id')->get();
            $data_std = DB::table('project_user')->where('id_reg_Std', $data_std_reg[0]->id)->select('project_user.*')->get();

            $datas_instructor = DB::table('projects')
                ->join('project_instructor', 'projects.id', '=', 'project_instructor.Project_id')
                ->join('teachers', 'project_instructor.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $data_std[0]->Project_id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();
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
        DB::table('project_user')->updateOrInsert([$table => $data[0]->id, "Project_id" => $id, 'isHead' => 0]);
    }
    public function Database_Project_instructor($id, $table, $data, $action, $is_action)
    {
        DB::table('project_instructor')->updateOrInsert([$table => $data[0]->id, "Project_id" => $id, $action => $is_action]);
    }

    public function createNameProject(Request $request)
    {
        $user = $request->user();
        $name_Instructor = Teacher::pluck('name_Instructor', 'id');
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

            $term = subject::query()->where('id', 'LIKE', "%{$request['subject']}%")->get();

            $name->save();
            $id =  $name->id;
            $data_nameProject = project::find($id);

            $fileModel->name_file = time() . '_' . $request->File->getClientOriginalName();
            $fileModel->status_file_path = "not Check";
            $fileModel->Project_id_File = $name->id;

            // $request->File->store("not Check");

            Storage::disk('local')->putFileAs(
                'not Check/' . $term[0]->year_term,
                $request->File,
                $fileModel->name_file
            );

            $fileModel->save();
            return view('/projects/list_name', compact("data_nameProject", "name_Instructor"));
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

            $term = subject::query()->where('id', 'LIKE', "%{$request['subject']}%")->get();

            $name->save();
            $id =  $name->id;
            $data_nameProject = project::find($id);
            $term = $request->user()->id;
            $term = reg_std::query()->where('user_id', 'LIKE', $term)->get();
            $fileModel->name_file = time() . '_' . $request->File->getClientOriginalName();
            $fileModel->status_file_path = "not Check";
            $fileModel->Project_id_File = $name->id;

            Storage::disk('local')->putFileAs(
                'not Check/' . $term[0]->year_term,
                $request->File,
                $fileModel->name_file
            );
            $fileModel->save();
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
                ->join('project_instructor', 'projects.id', '=', 'project_instructor.Project_id')
                ->join('teachers', 'project_instructor.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $id]])->get();
            return view('/word-template/test50', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        }
        if ($id_user == $id) {
            $user = $request->user()->id;
            $data_std_reg = DB::table('reg_stds')->where('user_id', $user)->select('reg_stds.id')->get();
            $data_std = DB::table('project_user')->where('id_reg_Std', $data_std_reg[0]->id)->select('project_user.*')->get();

            $datas_instructor = DB::table('projects')
                ->join('project_instructor', 'projects.id', '=', 'project_instructor.Project_id')
                ->join('teachers', 'project_instructor.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $data_std[0]->Project_id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
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
                ->join('project_instructor', 'projects.id', '=', 'project_instructor.Project_id')
                ->join('teachers', 'project_instructor.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $id]])->get();
            return view('/word-template/ChangeBoard', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        }
        if ($id_user == $id) {
            $user = $request->user()->id;
            $data_std_reg = DB::table('reg_stds')->where('user_id', $user)->select('reg_stds.id')->get();
            $data_std = DB::table('project_user')->where('id_reg_Std', $data_std_reg[0]->id)->select('project_user.*')->get();

            $datas_instructor = DB::table('projects')
                ->join('project_instructor', 'projects.id', '=', 'project_instructor.Project_id')
                ->join('teachers', 'project_instructor.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $data_std[0]->Project_id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
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
                ->join('project_instructor', 'projects.id', '=', 'project_instructor.Project_id')
                ->join('teachers', 'project_instructor.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $id]])->get();
            return view('/word-template/ChangeTopic', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        }
        if ($id_user == $id) {
            $user = $request->user()->id;
            $data_std_reg = DB::table('reg_stds')->where('user_id', $user)->select('reg_stds.id')->get();
            $data_std = DB::table('project_user')->where('id_reg_Std', $data_std_reg[0]->id)->select('project_user.*')->get();

            $datas_instructor = DB::table('projects')
                ->join('project_instructor', 'projects.id', '=', 'project_instructor.Project_id')
                ->join('teachers', 'project_instructor.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $data_std[0]->Project_id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();
            return view('/word-template/ChangeTopic', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        } else {
            abort(404);
        }
    }
    public function wordExport_ChangeTopic(Request $request){
        $request->validate([
            'note' => 'required',
            'new_project_name_thai'=> 'required',
            'new_project_name_eg'=>'required'
        ]);
        $templateProcessor = new TemplateProcessor('word-template/08-คำร้องทั่วไป-ขออนุญาตเปลี่ยนแปลงหัวข้อโครงงานคอมพิวเตอร์.docx');
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

        $fileName = "ขออนุญาตเปลี่ยนแปลงหัวข้อโครงงานคอมพิวเตอร์";
        $templateProcessor->saveAs($fileName . '.docx');

        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }
    public function CompleteForm(Request $request, $id){
        $id_user = Auth::user()->id;
        $user = $request->user();
        $name_Instructor = Teacher::pluck('name_Instructor', 'id');
        if ($user->hasRole('Admin')) {
            $datas_instructor = DB::table('projects')
                ->join('project_instructor', 'projects.id', '=', 'project_instructor.Project_id')
                ->join('teachers', 'project_instructor.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $id]])->get();
            return view('/word-template/CompleteForm', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        }
        if ($id_user == $id) {
            $user = $request->user()->id;
            $data_std_reg = DB::table('reg_stds')->where('user_id', $user)->select('reg_stds.id')->get();
            $data_std = DB::table('project_user')->where('id_reg_Std', $data_std_reg[0]->id)->select('project_user.*')->get();

            $datas_instructor = DB::table('projects')
                ->join('project_instructor', 'projects.id', '=', 'project_instructor.Project_id')
                ->join('teachers', 'project_instructor.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $data_std[0]->Project_id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
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
                ->join('project_instructor', 'projects.id', '=', 'project_instructor.Project_id')
                ->join('teachers', 'project_instructor.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $id]])->get();
            return view('/word-template/test100', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        }
        if ($id_user == $id) {
            $user = $request->user()->id;
            $data_std_reg = DB::table('reg_stds')->where('user_id', $user)->select('reg_stds.id')->get();
            $data_std = DB::table('project_user')->where('id_reg_Std', $data_std_reg[0]->id)->select('project_user.*')->get();

            $datas_instructor = DB::table('projects')
                ->join('project_instructor', 'projects.id', '=', 'project_instructor.Project_id')
                ->join('teachers', 'project_instructor.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $data_std[0]->Project_id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();
            return view('/word-template/test100', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        } else {
            abort(404);
        }
    }
    public function wordExport_CompleteForm(Request $request){
        $templateProcessor = new TemplateProcessor('word-template/05-แบบขอส่งโครงงานฉบับสมบูรณ์.docx');
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

        $fileName = "แบบขอส่งโครงงานฉบับสมบูรณ์";
        $templateProcessor->saveAs($fileName . '.docx');

        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }
    public function wordExport_test50(Request $request ,$id)
    {

        $request->validate([
            'room_test50' => 'required',
            'File' => 'required|file|mimes:zip',
        ]);
        $name_file =time() . '_' . $request->File->getClientOriginalName();
        //Database
            test50::create([
                'Project_id_test50'=>$id,
                'date_test50' => $request->date_test50,
                'end_date_test50' =>formatDateEnd_test($request->date_test50),
                'room_test50'=> $request->room_test50,
                'file_test50'=>time() . '_' . $request->File->getClientOriginalName(),
                'status_test50'=>'not check'
            ]);
            Storage::disk('local')->putFileAs(
                'test50/not Check',
                $request->File,
                $name_file
            );

        //wordExport
        $templateProcessor = new TemplateProcessor('word-template/02-แบบเสนอขอสอบ50.docx');
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

        $fileName = "แบบเสนอขอสอบ50";
        $templateProcessor->saveAs($fileName . '.docx');

        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }
    public function wordExport_ChangeBoard(Request $request){
        $request->validate([
            'note' => 'required',
        ]);
        $templateProcessor = new TemplateProcessor('word-template/07-คำร้องทั่วไป-ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์.docx');
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

        $fileName = "ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์";
        $templateProcessor->saveAs($fileName . '.docx');

        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }
    public function wordExport_test100(Request $request,$id)
    {
        $request->validate([
            'room_test100' => 'required',
            'File' => 'required|file|mimes:zip',
        ]);
        $name_file = time() . '_' . $request->File->getClientOriginalName();
        //Database
            test100::create([
                'Project_id_test100'=>$id,
                'date_test100' => $request->date_test100,
                'end_date_test100' =>formatDateEnd_test($request->date_test100),
                'room_test100'=> $request->room_test100,
                'file_test100'=>$name_file,
                'status_test100'=>'not check'
            ]);
            Storage::disk('local')->putFileAs(
                'test100/not Check',
                $request->File,
                $name_file
            );
        $templateProcessor = new TemplateProcessor('word-template/04-แบบเสนอขอสอบ100.docx');
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

        $fileName = "แบบเสนอขอสอบ100";
        $templateProcessor->saveAs($fileName . '.docx');

        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }
    public function ProgressReport(Request $request, $id){
        $id_user = Auth::user()->id;
        $user = $request->user();
        $name_Instructor = Teacher::pluck('name_Instructor', 'id');
        if ($user->hasRole('Admin')) {
            $datas_instructor = DB::table('projects')
                ->join('project_instructor', 'projects.id', '=', 'project_instructor.Project_id')
                ->join('teachers', 'project_instructor.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $id]])->get();
            return view('/word-template/ProgressReport', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        }
        if ($id_user == $id) {
            $user = $request->user()->id;
            $data_std_reg = DB::table('reg_stds')->where('user_id', $user)->select('reg_stds.id')->get();
            $data_std = DB::table('project_user')->where('id_reg_Std', $data_std_reg[0]->id)->select('project_user.*')->get();

            $datas_instructor = DB::table('projects')
                ->join('project_instructor', 'projects.id', '=', 'project_instructor.Project_id')
                ->join('teachers', 'project_instructor.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $data_std[0]->Project_id)->get();

            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();

            $datas_std = DB::table('projects')
                ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $data_std[0]->Project_id]])->get();
            return view('/word-template/ProgressReport', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        } else {
            abort(404);
        }
    }
    public function wordExport_ProgressReport(Request $request){
        $templateProcessor = new TemplateProcessor('word-template/03-รายงานการสอบความก้าวหน้า.docx');
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

        $templateProcessor->setValue('name_Thai', $request->Project_name_thai);
        $templateProcessor->setValue('name_Eng', $request->Project_name_eg);
        $templateProcessor->setValue('date_now', formatDateThai(date("Y-m-d")));

        $fileName = "รายงานการสอบความก้าวหน้า";
        $templateProcessor->saveAs($fileName . '.docx');

        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }
}
