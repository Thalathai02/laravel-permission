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


class projectControllers extends Controller
{

    protected $DataTableController;

    /**
     * Create a new controller instance.
     * @return void
     *
     */
    public function __construct(DataTableController $DataTableController)
    {
        $this->DataTableController = $DataTableController;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paginate($items, $perPage = 10, $page = null, $options = ['path' => 'http://127.0.0.1:8000/project'])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->hasRole('Admin')) {
            // $datas = project::orderBy('id', 'ASC')->paginate(10);
            $datas = $this->DataTableController->data_project_index();
            $datas = $this->paginate($datas);

            // $datas = collect($datas);
            // ->groupBy('id');
            // return response()->json($datas);
            return view('projects.projects', compact('datas'));
        }
        if ($user->hasRole('Tea')) {
            $datas = $this->DataTableController->data_project_index();
            $datas = $this->paginate($datas);
            return view('projects.projects', compact('datas'));
        }
        if ($user->hasRole('Std')) {
            $user = $request->user()->id;
            $data_std1 = DB::table('reg_stds')->where('user_id', $user)->select('reg_stds.id')->get();
            $data_std = DB::table('project_users')->where('id_reg_Std', $data_std1[0]->id)->select('project_users.*')->get();
            if (!empty($data_std[0]->id)) {
                $status = DB::table('projects')->where('id', '=', $data_std[0]->Project_id)->select('projects.status')->get();
                $datas = $this->DataTableController->data_project_index();
                $datas = $this->paginate($datas);
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
                $datas = $this->DataTableController->data_project_index();
                $datas = $this->paginate($datas);
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
            $term = subject_student::where('student_id', $user_id)->get();
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
            $datas_instructor = project::join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where([['projects.id', '=', $id], ['projects.deleted_at', null]])->get();

            $datas = project::select('projects.*')->where([['projects.id', '=', $id], ['projects.deleted_at', null]])->get();

            // $datas_std = $this->DataTableController->data_project($id);
            $datas_std = project::join('project_users', 'projects.id', '=', 'project_users.Project_id')
                ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
                ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $id], ['project_users.deleted_at', null]])->get();
            return view('projects.Edit_Project.index', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        }
        if ($user->hasRole('Std')) {
            if (project::where([['status', 'reject'], ['id', $id]])->first()) {
                $id_reg = reg_std::where('user_id', $id)->get();
                $id_reg_Std = project_user::where('id_reg_Std', $id_reg[0]->id)->get();
                //  return response()->json($id_reg_Std[0]->id);
                $datas_instructor = DB::table('projects')
                    ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                    ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                    ->select('teachers.*')->where('projects.id', '=', $id_reg_Std[0]->id)->get();

                $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $id_reg_Std[0]->id]])->get();

                // $datas_std = $this->DataTableController->data_project($id_reg_Std[0]->id);
                $datas_std = DB::table('projects')
                    ->join('project_users', 'projects.id', '=', 'project_users.Project_id')
                    ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                    ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
                    ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=', $id_reg_Std[0]->id], ['project_users.deleted_at', null]])->get();
                return view('projects.Edit_Project.index', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
            } else {
                abort(404);
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
            $Search = $request->get('reg_std1');
            $data = reg_std::query()->where('std_code', 'LIKE', "{$Search}")->get();
            project::where('id', $id)->update(['name_mentor' => $request->get('name_mentor')]);
            project_user::updateOrCreate(['id_reg_Std' => $data[0]->id, "Project_id" => $id, 'isHead' => 1], ['id_reg_Std' => $data[0]->id, "Project_id" => $id, 'isHead' => 1]);
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
                    $this->Database_Project_instructor($id, 'ID_Instructor', $name_director2, $action = "Is_director", $is_action = 2);
                }
            }
            // DB::table('projects')->where('id', $id)->update(['id_regStd1' => $data[0]->id, 'id_regStd2' => $data2[0]->id]);
            return redirect("/project");
            // return response()->json([
            //     'id' => $id,
            //     'reg_std1' => $data,
            //     'reg_std2' => $data2,
            //     'reg_std3' => $data3,

            // ]);
        }
        if ($user->hasRole('Std')) {
            $Search = $request->get('reg_std1');
            $data = reg_std::query()->where('std_code', 'LIKE', "{$Search}")->get();
            project::where('id', $id)->update(['name_mentor' => $request->get('name_mentor')]);
            project_user::updateOrCreate(['id_reg_Std' => $data[0]->id, "Project_id" => $id, 'isHead' => 1], ['id_reg_Std' => $data[0]->id, "Project_id" => $id, 'isHead' => 1]);
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
                    $this->Database_Project_instructor($id, 'ID_Instructor', $name_director2, $action = "Is_director", $is_action = 2);
                }
            }
            // DB::table('projects')->where('id', $id)->update(['id_regStd1' => $data[0]->id, 'id_regStd2' => $data2[0]->id]);

            return redirect("/project");
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
        project_user::updateOrCreate([$table => $data[0]->id, "Project_id" => $id, 'isHead' => 0], [$table => $data[0]->id, "Project_id" => $id, 'isHead' => 0]);
    }
    public function Database_Project_instructor($id, $table, $data, $action, $is_action)
    {
        project_instructor::updateOrCreate([$table => $data[0]->id, "Project_id" => $id, $action => $is_action], [$table => $data[0]->id, "Project_id" => $id, $action => $is_action]);
    }
    public function destroy_edit_name_project($id)
    {
        $id_reg = reg_std::where('std_code', $id)->first();
        // return response()->json($id_reg);
        project_user::where('id_reg_Std', $id_reg->id)->delete();

        return back()->with('success', 'successfully.');
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
                $term[0]->year_term,
                $request->File,
                $fileModel->name_file
            );

            $fileModel->save();
            return view('/projects/list_name', compact("data_nameProject", "name_Instructor"));
        }
        if ($user->hasRole('Std')) {
            $user_id = $request->user()->reg_std_id;
            $term = subject_student::where('student_id', $user_id)->get();
            $term = subject::find($term[0]->subject_id);
            $name = new project();
            $name->name_th = $request['Project_name_thai'];
            $name->name_en = $request['Project_name_eg'];
            $name->status = "Waiting";
            $name->subject_id = $term->id;

            // $term = subject::query()->where('id', 'LIKE', "%{$request['subject']}%")->get();

            // return response()->json($term); 
            $name->save();
            $id =  $name->id;
            $data_nameProject = project::find($id);

            $fileModel->name_file = time() . '_' . $request->File->getClientOriginalName();
            $fileModel->status_file_path = "Waiting";
            $fileModel->Project_id_File = $name->id;


            Storage::disk('local')->putFileAs(
                $term->year_term,
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

            $datas_std = $this->DataTableController->data_project($id);
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

            $datas_std = $this->DataTableController->data_project($data_std[0]->Project_id);
            return view('/word-template/test50', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        } else {
            abort(404);
        }
    }
    public function ChangeBoard(Request $request, $id)
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

            $datas_std = $this->DataTableController->data_project($id);
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

            $datas_std = $this->DataTableController->data_project($data_std[0]->Project_id);
            return view('/word-template/ChangeBoard', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        } else {
            abort(404);
        }
    }
    public function ChangeTopic(Request $request, $id)
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

            $datas_std = $this->DataTableController->data_project($id);
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

            $datas_std = $this->DataTableController->data_project($data_std[0]->Project_id);
            return view('/word-template/ChangeTopic', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        } else {
            abort(404);
        }
    }
    public function wordExport_ChangeTopic(Request $request, $id)
    {
        $request->validate([
            'note' => 'required',
            'new_project_name_thai' => 'required',
            'new_project_name_eg' => 'required'
        ]);
        $ChangeTopic_DB = ChangeTopic::create([
            'Project_id_changetopics' => $id,
            'old_name_th' => $request->Project_name_thai,
            'old_name_en' => $request->Project_name_eg,
            'new_name_th' => $request->new_project_name_thai,
            'new_name_en' => $request->new_project_name_eg,
            'note' => $request->note,
            'status_changetopics' => 'Waiting'
        ]);

        $Project_id = DB::table('project_instructors')->where('Project_id', $id)->get();
        $user_noti1 = User::where('reg_tea_id', $Project_id[0]->id_instructor)->get();
        $user_noti2 = User::where('reg_tea_id', $Project_id[1]->id_instructor)->get();
        $user_noti3 = User::where('reg_tea_id', $Project_id[2]->id_instructor)->get();

        $id_ChangeTopicDB = changetopic::find($ChangeTopic_DB->id);

        $this->notifications_fun($user_noti1[0]->id, 7, $id_ChangeTopicDB->id, 'ขออนุญาตเปลี่ยนแปลงหัวข้อโครงงานคอมพิวเตอร์');
        $this->notifications_fun($user_noti2[0]->id, 7, $id_ChangeTopicDB->id, 'ขออนุญาตเปลี่ยนแปลงหัวข้อโครงงานคอมพิวเตอร์');
        $this->notifications_fun($user_noti3[0]->id, 7, $id_ChangeTopicDB->id, 'ขออนุญาตเปลี่ยนแปลงหัวข้อโครงงานคอมพิวเตอร์');
        $this->notifications_fun(1, 7, $id_ChangeTopicDB->id, 'ขออนุญาตเปลี่ยนแปลงหัวข้อโครงงานคอมพิวเตอร์');

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
            $templateProcessor->setValue('and_name2', "และ ");
        } else {
            $templateProcessor->setValue('code2', "");
            $templateProcessor->setValue('phone_n2', "");
            $templateProcessor->setValue('id2', "");
            $templateProcessor->setValue('name2', "");
            $templateProcessor->setValue('phone2', "");
            $templateProcessor->setValue('and_name2', " ");
        }


        if (!empty($request->reg_std3)) {
            $templateProcessor->setValue('id3', $request->reg_std3);
            $templateProcessor->setValue('name3', $request->reg_std3_name);
            $templateProcessor->setValue('phone3', $request->reg_std3_Phone);
            $templateProcessor->setValue('code3', "รหัส ");
            $templateProcessor->setValue('phone_n3', "มือถือ ");
            $templateProcessor->setValue('and_name3', "และ ");
        } else {
            $templateProcessor->setValue('id3', "");
            $templateProcessor->setValue('name3', "");
            $templateProcessor->setValue('phone3', "");
            $templateProcessor->setValue('code3', "");
            $templateProcessor->setValue('phone_n3', "");
            $templateProcessor->setValue('and_name3', " ");
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

        $fileName = storage_path("ขออนุญาตเปลี่ยนแปลงหัวข้อโครงงานคอมพิวเตอร์" . '.docx');
        $templateProcessor->saveAs($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }
    public function CompleteForm(Request $request, $id)
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

            $datas_std = $this->DataTableController->data_project($id);
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

            $datas_std = $this->DataTableController->data_project($data_std[0]->Project_id);
            return view('/word-template/CompleteForm', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        } else {
            abort(404);
        }
    }
    public function test100(Request $request, $id)
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

            $datas_std = $this->DataTableController->data_project($id);
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

            $datas_std = $this->DataTableController->data_project($data_std[0]->Project_id);
            return view('/word-template/test100', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
        } else {
            abort(404);
        }
    }
    public function wordExport_CompleteForm(Request $request, $id)
    {


        //Database
        $CompleteForm_DB = CompleteForm::create([
            'Project_id_CompleteForm' => $id,
            'status_CompleteForm' => 'Waiting'
        ]);


        // return response()->json($CompleteForm_DB->id);
        $this->notifications_fun(1, 5, $CompleteForm_DB->id, 'แบบขอส่งโครงงานฉบับสมบูรณ์');

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
            $templateProcessor->setValue('id2', "");
            $templateProcessor->setValue('name2', "");
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

        $fileName = storage_path("แบบขอส่งโครงงานฉบับสมบูรณ์" . '.docx');
        $templateProcessor->saveAs($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }
    public function wordExport_test50(Request $request, $id)
    {

        $request->validate([
            'room_test50' => 'required',
            'File' => 'required|file|mimes:zip',
        ]);
        $name_file = time() . '_' . $request->File->getClientOriginalName();
        //Database
        $test50_DB = test50::create([
            'Project_id_test50' => $id,
            'date_test50' => $request->date_test50,
            'end_date_test50' => formatDateEnd_test($request->date_test50),
            'room_test50' => $request->room_test50,
            'file_test50' => time() . '_' . $request->File->getClientOriginalName(),
            'status_test50' => 'Waiting'
        ]);
        Storage::disk('local')->putFileAs(
            'test50',
            $request->File,
            $name_file
        );
        $Project_id = DB::table('project_instructors')->where('Project_id', $id)->get();
        $user_noti1 = User::where('reg_tea_id', $Project_id[0]->id_instructor)->get();
        $user_noti2 = User::where('reg_tea_id', $Project_id[1]->id_instructor)->get();
        $user_noti3 = User::where('reg_tea_id', $Project_id[2]->id_instructor)->get();
        $id_test50DB = test50::find($test50_DB->id);
        $this->notifications_fun($user_noti1[0]->id, 1, $id_test50DB->id, 'แบบเสนอขอสอบ50');
        $this->notifications_fun($user_noti2[0]->id, 1, $id_test50DB->id, 'แบบเสนอขอสอบ50');
        $this->notifications_fun($user_noti3[0]->id, 1, $id_test50DB->id, 'แบบเสนอขอสอบ50');
        $this->notifications_fun(1, 1, $id_test50DB->id, 'แบบเสนอขอสอบ50');
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
            $templateProcessor->setValue('id2', "");
            $templateProcessor->setValue('name2', "");
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
        $templateProcessor->setValue('end_time', formatDateThai_End_time($request->date_test50));
        $templateProcessor->setValue('date_now', formatDateThai(date("Y-m-d")));

        $fileName = storage_path("แบบเสนอขอสอบ50" . '.docx');
        $templateProcessor->saveAs($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }
    public function wordExport_ChangeBoard(Request $request, $id)
    {
        $request->validate([
            'note' => 'required',
        ]);
        $ChangeBoard_DB = ChangeBoard::create([
            'Project_id_ChangeBoard' => $id,
            'old_name_president' => $request->name_president,
            'old_name_director1' => $request->name_director1,
            'old_name_director2' => $request->name_director2,
            'new_name_president' => $request->new_name_president,
            'new_name_director1' => $request->new_name_director1,
            'new_name_director2' => $request->new_name_director2,
            'note' => $request->note,
            'status_ChangeBoard' => 'Waiting'
        ]);

        $Project_id = DB::table('project_instructors')->where('Project_id', $id)->get();
        $user_noti1 = User::where('reg_tea_id', $Project_id[0]->id_instructor)->get();
        $user_noti2 = User::where('reg_tea_id', $Project_id[1]->id_instructor)->get();
        $user_noti3 = User::where('reg_tea_id', $Project_id[2]->id_instructor)->get();

        $new_user_noti1 = User::where('reg_tea_id', $request->new_name_president)->get();
        $new_user_noti2 = User::where('reg_tea_id', $request->new_name_director1)->get();
        $new_user_noti3 = User::where('reg_tea_id', $request->new_name_director2)->get();

        $id_ChangeBoardDB = ChangeBoard::find($ChangeBoard_DB->id);
        $this->notifications_fun($user_noti1[0]->id, 6, $id_ChangeBoardDB->id, 'ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์');
        $this->notifications_fun($user_noti2[0]->id, 6, $id_ChangeBoardDB->id, 'ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์');
        $this->notifications_fun($user_noti3[0]->id, 6, $id_ChangeBoardDB->id, 'ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์');

        switch ($new_user_noti1[0]->id) {
            case ($user_noti1[0]->id):
                break;
            case ($user_noti2[0]->id):
                break;
            case ($user_noti3[0]->id):
                break;
            default:
                $this->notifications_fun($new_user_noti1[0]->id, 6, $id_ChangeBoardDB->id, 'ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์');
                break;
        }
        switch ($new_user_noti2[0]->id) {
            case ($user_noti1[0]->id):
                break;
            case ($user_noti2[0]->id):
                break;
            case ($user_noti3[0]->id):
                break;
            default:
                $this->notifications_fun($new_user_noti2[0]->id, 6, $id_ChangeBoardDB->id, 'ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์');
                break;
        }
        switch ($new_user_noti3[0]->id) {
            default:
                $this->notifications_fun($new_user_noti3[0]->id, 6, $id_ChangeBoardDB->id, 'ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์');
                break;
            case ($user_noti1[0]->id):
                break;
            case ($user_noti2[0]->id):
                break;
            case ($user_noti3[0]->id):
                break;
        }

        // return response()->json($new_user_noti1[0]->id);
        $this->notifications_fun(1, 6, $id_ChangeBoardDB->id, 'ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์');

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
            $templateProcessor->setValue('and_name2', "และ ");
        } else {
            $templateProcessor->setValue('code2', "");
            $templateProcessor->setValue('phone_n2', "");
            $templateProcessor->setValue('id2', "");
            $templateProcessor->setValue('name2', "");
            $templateProcessor->setValue('phone2', "");
            $templateProcessor->setValue('and_name2', " ");
        }


        if (!empty($request->reg_std3)) {
            $templateProcessor->setValue('id3', $request->reg_std3);
            $templateProcessor->setValue('name3', $request->reg_std3_name);
            $templateProcessor->setValue('phone3', $request->reg_std3_Phone);
            $templateProcessor->setValue('code3', "รหัส ");
            $templateProcessor->setValue('phone_n3', "มือถือ ");
            $templateProcessor->setValue('and_name3', "และ ");
        } else {
            $templateProcessor->setValue('id3', "");
            $templateProcessor->setValue('name3', "");
            $templateProcessor->setValue('phone3', "");
            $templateProcessor->setValue('code3', "");
            $templateProcessor->setValue('phone_n3', "");
            $templateProcessor->setValue('and_name3', " ");
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

        $templateProcessor->setValue('new_name_president', $new_name_president[0]->Title_name_Instructor . $new_name_president[0]->name_Instructor);
        $templateProcessor->setValue('new_name_director1', $new_name_director1[0]->Title_name_Instructor . $new_name_director1[0]->name_Instructor);
        $templateProcessor->setValue('new_name_director2', $new_name_director2[0]->Title_name_Instructor . $new_name_director2[0]->name_Instructor);
        $templateProcessor->setValue('note', $request->note);
        $templateProcessor->setValue('date_now', formatDateThai(date("Y-m-d")));

        $fileName = storage_path("ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์" . '.docx');
        $templateProcessor->saveAs($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }
    public function wordExport_test100(Request $request, $id)
    {
        $request->validate([
            'room_test100' => 'required',
            'File' => 'required|file|mimes:zip',
        ]);
        $name_file = time() . '_' . $request->File->getClientOriginalName();
        //Database
        $test100_DB = test100::create([
            'Project_id_test100' => $id,
            'date_test100' => $request->date_test100,
            'end_date_test100' => formatDateEnd_test($request->date_test100),
            'room_test100' => $request->room_test100,
            'file_test100' => $name_file,
            'status_test100' => 'Waiting'
        ]);
        Storage::disk('local')->putFileAs(
            'test100',
            $request->File,
            $name_file
        );
        $Project_id = DB::table('project_instructors')->where('Project_id', $id)->get();
        $user_noti1 = User::where('reg_tea_id', $Project_id[0]->id_instructor)->get();
        $user_noti2 = User::where('reg_tea_id', $Project_id[1]->id_instructor)->get();
        $user_noti3 = User::where('reg_tea_id', $Project_id[2]->id_instructor)->get();
        $id_test100DB = test100::find($test100_DB->id);
        $this->notifications_fun($user_noti1[0]->id, 3, $id_test100DB->id, 'แบบเสนอขอสอบ100');
        $this->notifications_fun($user_noti2[0]->id, 3, $id_test100DB->id, 'แบบเสนอขอสอบ100');
        $this->notifications_fun($user_noti3[0]->id, 3, $id_test100DB->id, 'แบบเสนอขอสอบ100');
        $this->notifications_fun(1, 3, $id_test100DB->id, 'แบบเสนอขอสอบ100');
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
            $templateProcessor->setValue('id2', "");
            $templateProcessor->setValue('name2', "");
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
        $templateProcessor->setValue('end_time', formatDateThai_End_time($request->date_test100));
        $templateProcessor->setValue('date_now', formatDateThai(date("Y-m-d")));

        $fileName = storage_path("แบบเสนอขอสอบ100" . '.docx');
        $templateProcessor->saveAs($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }
    public function ProgressReport_test50(Request $request, $id)
    {
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

            $datas_std = $this->DataTableController->data_project($data_std[0]->Project_id);

            $time_test50 = test50::where('Project_id_test50', $datas[0]->id)->get();
            return view('/word-template/ProgressReport_test50', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor', 'time_test50'));
        } else {
            abort(404);
        }
    }
    public function wordExport_ProgressReport_test50(Request $request, $id)
    {



        //Database
        $ProgressReport_test50_DB = ProgressReport_test50::create([
            'Project_id_report_test50' => $id,
            'status_progress_report_test50' => 'Waiting'
        ]);

        $Project_id = DB::table('project_instructors')->where('Project_id', $id)->get();
        $user_noti1 = User::where('reg_tea_id', $Project_id[0]->id_instructor)->get();
        $user_noti2 = User::where('reg_tea_id', $Project_id[1]->id_instructor)->get();
        $user_noti3 = User::where('reg_tea_id', $Project_id[2]->id_instructor)->get();
        $id_ProgressReport_test50_DB = ProgressReport_test50::find($ProgressReport_test50_DB->id);
        $this->notifications_fun($user_noti1[0]->id, 2, $id_ProgressReport_test50_DB->id, 'รายงานการสอบความก้าวหน้าสอบ50');
        $this->notifications_fun($user_noti2[0]->id, 2, $id_ProgressReport_test50_DB->id, 'รายงานการสอบความก้าวหน้าสอบ50');
        $this->notifications_fun($user_noti3[0]->id, 2, $id_ProgressReport_test50_DB->id, 'รายงานการสอบความก้าวหน้าสอบ50');
        $this->notifications_fun(1, 2, $id_ProgressReport_test50_DB->id, 'รายงานการสอบความก้าวหน้าสอบ50');

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
            $templateProcessor->setValue('id2', "");
            $templateProcessor->setValue('name2', "");
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
        $templateProcessor->setValue('date_test', $request->date_test);

        $templateProcessor->setValue('name_Thai', $request->Project_name_thai);
        $templateProcessor->setValue('name_Eng', $request->Project_name_eg);
        $templateProcessor->setValue('date_now', formatDateThai(date("Y-m-d")));

        $fileName = storage_path("รายงานการสอบความก้าวหน้า50" . '.docx');
        $templateProcessor->saveAs($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }
    public function ProgressReport_test100(Request $request, $id)
    {
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

            $datas_std = $this->DataTableController->data_project($data_std[0]->Project_id);
            $time_test100 = test100::where('Project_id_test100', $datas[0]->id)->get();
            return view('/word-template/ProgressReport_test100', compact('id', 'datas_std', 'datas_instructor', 'datas', 'name_Instructor', 'time_test100'));
        } else {
            abort(404);
        }
    }
    public function wordExport_ProgressReport_test100(Request $request, $id)
    {
        //Database
        $ProgressReport_test50_DB = ProgressReport_test100::create([
            'Project_id_report_test100' => $id,
            'status_progress_report_test100' => 'Waiting'
        ]);

        $Project_id = DB::table('project_instructors')->where('Project_id', $id)->get();
        $user_noti1 = User::where('reg_tea_id', $Project_id[0]->id_instructor)->get();
        $user_noti2 = User::where('reg_tea_id', $Project_id[1]->id_instructor)->get();
        $user_noti3 = User::where('reg_tea_id', $Project_id[2]->id_instructor)->get();
        $id_ProgressReport_test100_DB = ProgressReport_test100::find($ProgressReport_test50_DB->id);
        $this->notifications_fun($user_noti1[0]->id, 4, $id_ProgressReport_test100_DB->id, 'รายงานการสอบความก้าวหน้าสอบ100');
        $this->notifications_fun($user_noti2[0]->id, 4, $id_ProgressReport_test100_DB->id, 'รายงานการสอบความก้าวหน้าสอบ100');
        $this->notifications_fun($user_noti3[0]->id, 4, $id_ProgressReport_test100_DB->id, 'รายงานการสอบความก้าวหน้าสอบ100');
        $this->notifications_fun(1, 4, $id_ProgressReport_test100_DB->id, 'รายงานการสอบความก้าวหน้าสอบ100');
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
            $templateProcessor->setValue('id2', "");
            $templateProcessor->setValue('name2', "");
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
        $templateProcessor->setValue('date_test', $request->date_test);

        $templateProcessor->setValue('name_Thai', $request->Project_name_thai);
        $templateProcessor->setValue('name_Eng', $request->Project_name_eg);
        $templateProcessor->setValue('date_now', formatDateThai(date("Y-m-d")));

        $fileName = storage_path("รายงานการสอบความก้าวหน้า" . '.docx');
        $templateProcessor->saveAs($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }
    public function notifications_fun($id_Instructor, $form, $form_id, $Title_form)
    {
        $sendToUser  = User::find($id_Instructor);
        $sendToUser->notify(new InvoicePaid($form, $form_id, $Title_form, Auth::user()));
        // Notification::send($id_Instructor ,new InvoicePaid($form ,$form_id));
    }
    public function edit_project(Request $request, $id)
    {

        if (Auth::user()->hasRole('Admin')) {
            $project_id = project::find($id);
            $project_id->name_th = $request->Project_name_thai;
            $project_id->name_en = $request->Project_name_eg;
            $project_id->name_mentor = $request->name_mentor;
            $project_id->save();
            $id_stu_project = project_user::where('Project_id', $id)->get();
            if ($request->reg_std1 != 0) {
                $id_reg1 = reg_std::where('std_code', $request->reg_std1)->get();
                $id_stu_project[0]->id_reg_Std = $id_reg1[0]->id;
                $id_stu_project[0]->save();
            }
            if ($request->reg_std2 != 0) {
                $id_reg2 = reg_std::where('std_code', $request->reg_std2)->get();
                project_user::updateOrCreate(
                    ['Project_id' => $id, 'id_reg_Std' => $id_reg2[0]->id],
                    ['Project_id' => $id, 'id_reg_Std' => $id_reg2[0]->id, 'isHead' => 0]
                );
            }
            if ($request->reg_std3 != 0) {
                $id_reg3 = reg_std::where('std_code', $request->reg_std3)->get();
                // $id_stu_project[2]->id_reg_Std = $id_reg3[0]->id;
                // $id_stu_project[2]->save();
                project_user::updateOrCreate(
                    ['Project_id' => $id, 'id_reg_Std' => $id_reg3[0]->id],
                    ['Project_id' => $id, 'id_reg_Std' => $id_reg3[0]->id, 'isHead' => 0]
                );
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

            $name_president = project_instructor::where('Project_id', $id)->get();

            if ($request->name_president != 0) {
                $name_president[0]->id_instructor = $request->name_president;
                $name_president[0]->save();
            }
            if ($request->name_director1 != 0) {
                $name_president[1]->id_instructor = $request->name_director1;
                $name_president[1]->save();
            }
            if ($request->name_director2 != 0) {
                $name_president[2]->id_instructor = $request->name_director2;
                $name_president[2]->save();
            }
            if ($request->name_mentor != 0) {
                project::updateOrCreate(
                    ['Project_id' => $id, 'name_mentor' => $request->name_mentor],
                    ['Project_id' => $id, 'name_mentor' => $request->name_mentor]
                );
            }
            // $datas = project::orderBy('id', 'ASC')->paginate(10);

            return redirect("/project");
            // return view('projects.projects', compact('datas'));
        }
        if (Auth::user()->hasRole('Std')) {
            $request->validate([
                'File' => 'required|file|mimes:zip',

            ]);
            $project_id = project::find($id);
            $project_id->name_th = $request->Project_name_thai;
            $project_id->name_en = $request->Project_name_eg;
            $project_id->status = 'Waiting';
            $project_id->because_reject = '-';
            $project_id->name_mentor = $request->name_mentor;
            $project_id->save();
            $fileModel = Project_File::find(["Project_id_File", $id]);
            $fileModel[0]->name_file = time() . '_' . $request->File->getClientOriginalName();
            $fileModel[0]->status_file_path = "Waiting";
            $subject = subject::find($project_id->subject_id);
            //  return response()->json($project_id);
            Storage::disk('local')->putFileAs(
                $subject->year_term,
                $request->File,
                $fileModel[0]->name_file
            );

            $fileModel[0]->save();

            $id_stu_project = project_user::query()->where('Project_id', $id)->get();
            if ($request->reg_std1 != 0) {
                $id_reg1 = reg_std::where('std_code', $request->reg_std1)->get();
                $id_stu_project[0]->id_reg_Std = $id_reg1[0]->id;
                $id_stu_project[0]->save();
            }
            if ($request->reg_std2 != 0) {
                $id_reg2 = reg_std::where('std_code', $request->reg_std2)->get();
                project_user::updateOrCreate(
                    ['Project_id' => $id, 'id_reg_Std' => $id_reg2[0]->id],
                    ['Project_id' => $id, 'id_reg_Std' => $id_reg2[0]->id, 'isHead' => 0]
                );
            }
            if ($request->reg_std3 != 0) {
                $id_reg3 = reg_std::where('std_code', $request->reg_std3)->get();
                // $id_stu_project[2]->id_reg_Std = $id_reg3[0]->id;
                // $id_stu_project[2]->save();
                project_user::updateOrCreate(
                    ['Project_id' => $id, 'id_reg_Std' => $id_reg3[0]->id],
                    ['Project_id' => $id, 'id_reg_Std' => $id_reg3[0]->id, 'isHead' => 0]
                );
            }

            $name_president = project_instructor::where('Project_id', $id)->get();

            if ($request->name_president != 0) {
                $name_president[0]->id_instructor = $request->name_president;
                $name_president[0]->save();
            }
            if ($request->name_director1 != 0) {
                $name_president[1]->id_instructor = $request->name_director1;
                $name_president[1]->save();
            }
            if ($request->name_director2 != 0) {
                $name_president[2]->id_instructor = $request->name_director2;
                $name_president[2]->save();
            }

            return redirect("/project");
            // $user = $request->user()->id;
            // $data_std1 = DB::table('reg_stds')->where('user_id', $user)->select('reg_stds.id')->get();
            // $data_std = DB::table('project_users')->where('id_reg_Std', $data_std1[0]->id)->select('project_users.*')->get();
            // if (!empty($data_std[0]->id)) {
            //     $status = DB::table('projects')->where('id', '=', $data_std[0]->Project_id)->select('projects.status')->get();
            //     $datas = project::orderBy('id', 'ASC')->paginate(10);
            //     if ($status[0]->status == "reject") {
            //         return view('projects.projects', compact('datas', 'data_std', 'status'));
            //     } elseif ($status[0]->status == "Waiting") {
            //         return view('projects.projects', compact('datas', 'data_std', 'status'));
            //     } elseif ($status[0]->status == "Check") {
            //         return view('projects.projects', compact('datas', 'data_std', 'status'));
            //     } else {
            //         $status = null;
            //         return view('projects.projects', compact('datas', 'data_std', 'status'));
            //     }
            // } else {
            //     $data_std = null;
            //     $status = null;
            //     $datas = project::orderBy('id', 'ASC')->paginate(10);
            //     return view('projects.projects', compact('datas', 'data_std', 'status'));
            // }
        }
    }
    public function info_project($id)
    {
        $mydata = User::find($id);
        $data_reg1 = reg_std::where('user_id', $mydata->id)->get();
        $id_stu_project = project_user::query()->where('id_reg_Std', $data_reg1[0]->id)->get();
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
            $datas_std = $this->DataTableController->data_project($id_stu_project[0]->Project_id);
            return view('projects.info_project', compact('datas', 'datas_std', 'datas_instructor'));
        } else {
            $datas_std = $this->DataTableController->data_project($id_stu_project[0]->Project_id);
            return view('projects.info_project', compact('datas_std', 'datas'));
        }
    }
    public function president_page()
    {
        $user = Auth::user();
        if ($user->hasRole('Tea')) {
            $term = subject::pluck('year_term', 'id');
            $datas = project::orderBy('id', 'ASC')->paginate(10);
            return view('projects.ProjectAdvisor.president', compact('term', 'datas'));
        } else {
            abort(404);
        }
    }
    public function president_show(Request $request)
    {
        $user = Auth::user();
        if ($user->hasRole('Tea')) {
            $data_subject = $request->get(
                'subject'
            );
            $term = subject::pluck('year_term', 'id');
            $data_subject = project_instructor::query()->where([['id_instructor', 'LIKE', $user->reg_tea_id], ['Is_president', 'LIKE', 1]])->paginate(10);
            $datas = project::query()->where([['id', 'LIKE', $data_subject[0]->Project_id], ['subject_id', $request->subject]])->paginate(10);
            // return response()->json( $request->subject);
            return view('projects.ProjectAdvisor.president_show', compact('term', 'datas'));
        } else {
            abort(404);
        }
    }
    public function director_page()
    {
        $user = Auth::user();
        if ($user->hasRole('Tea')) {
            $term = subject::pluck('year_term', 'id');
            $datas = project::orderBy('id', 'ASC')->paginate(10);
            return view('projects.ProjectAdvisor.director', compact('term', 'datas'));
        } else {
            abort(404);
        }
    }
    public function director_show(Request $request)
    {
        $user = Auth::user();
        if ($user->hasRole('Tea')) {
            $data_subject = $request->get(
                'subject'
            );
            $term = subject::pluck('year_term', 'id');
            $data_subject = project_instructor::query()->where([['id_instructor', 'LIKE', $user->reg_tea_id], ['Is_director', 'LIKE', 1]])->orWhere([['Is_director', 2]])->paginate(10);
            $datas = project::query()->where([['id', 'LIKE', $data_subject[0]->Project_id], ['subject_id', $request->subject]])->paginate(10);
            // return response()->json( $datas);
            return view('projects.ProjectAdvisor.director_show', compact('term', 'datas'));
        } else {
            abort(404);
        }
    }
    public function comment_test50($id)
    {
        $user = Auth::user();
        if ($user->hasRole('Tea')) {
            $datas_instructor = project::join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $id)->get();
            $datas = project::select('projects.*')->where([['projects.id', '=', $id]])->get();
            $tableTest50_id = test50::where('Project_id_test50', '=', $id)->first();
            $datas_std = $this->DataTableController->data_project($id);
            // return view('projects.ProjectAdvisor.test50', compact('id', 'datas_std', 'datas_instructor', 'datas', 'tableTest50_id'));

            $data_reject_test = comment_test50::where([['project_id_comemt_test50',$id],['action_comemt_test50',2],['id_instructor_comemt_test50',Auth::user()->reg_tea_id]])->first();
            if(isset($data_reject_test)){
                $point_test50 =point_test50::where([['project_id_point_test50',$id],['id_instructor_point_test50',Auth::user()->reg_tea_id]])->get();
                // return response()->json($point_test50);
                return view('projects.ProjectAdvisor.test50', compact('id', 'datas_std', 'datas_instructor', 'datas', 'tableTest50_id','data_reject_test','point_test50'));
            }else{
                return view('projects.ProjectAdvisor.test50', compact('id', 'datas_std', 'datas_instructor', 'datas', 'tableTest50_id'));
            }
            
        }
    }
    public function comment_test50_page()
    {
        $user = Auth::user();
        if ($user->hasRole('Tea')) {
            $data_user = user::find($user->id);
            $data_project_instructors = project_instructor::where('id_instructor', $data_user->reg_tea_id)->get();
            // comment_test50::all();
            foreach ($data_project_instructors as $key => $data_test50s) {
                $check_test50 = test50::where('Project_id_test50', $data_test50s->Project_id)->first();
                $comment_test50 = comment_test50::where([['action_comemt_test50',1],['project_id_comemt_test50', $data_test50s->Project_id], ['id_instructor_comemt_test50', $data_user->reg_tea_id]])->first();
                if (isset($comment_test50)) {
                } else {
                    if (isset($check_test50)) {
                        $data_project[] = $check_test50;
                    }
                }
            }
            if (!empty($data_project)) {
                foreach ($data_project as $key => $data_project_instructor) {
                    $data_test50[] = project::where('id', $data_project_instructor->Project_id_test50)->first();
                    // $data_test50[] =$data_project_instructor;
                }
            } else {
                $data_test50 = null;
            }

            // return response()->json($comment_test50);
            return view('projects.ProjectAdvisor.test50_page', compact('data_test50'));
        }
    }
    public function comment_test50_Datas(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->hasRole('Tea')) {
            $id_user = user::find($user->id);
            if (isset($request->reg_std1)) {
                $std_1 = reg_std::where('std_code', $request->reg_std1)->first();
                // $point_test50 = new point_test50();
                // $point_test50->project_id_point_test50 = $id;
                // $point_test50->id_instructor_point_test50 = $id_user->reg_tea_id;
                // $point_test50->point_test50 = $request->point_reg_std1;
                // $point_test50->reg_id_point_test50 = $std_1->id;
                // $point_test50->status_point_test50 = 'Waiting';
                // $point_test50->save();
                point_test50::updateOrCreate(
                    ['reg_id_point_test50'=>$std_1->id,'project_id_point_test50'=> $id,'id_instructor_point_test50'=> $id_user->reg_tea_id],
                    ['point_test50'=>$request->point_reg_std1,"status_point_test50" => "Waiting"]
                );

            }
            if (isset($request->reg_std2)) {
                $std_2 = reg_std::where('std_code', $request->reg_std2)->first();
                // $point_test50 = new point_test50();
                // $point_test50->project_id_point_test50 = $id;
                // $point_test50->id_instructor_point_test50 = $id_user->reg_tea_id;
                // $point_test50->point_test50 = $request->point_reg_std2;
                // $point_test50->reg_id_point_test50 = $std_2->id;
                // $point_test50->status_point_test50 = 'Waiting';
                // $point_test50->save();

                point_test50::updateOrCreate(
                    ['reg_id_point_test50'=>$std_2->id,'project_id_point_test50'=> $id,'id_instructor_point_test50'=>$id_user->reg_tea_id],
                    ['point_test50'=>$request->point_reg_std2,'status_point_test50'=>'Waiting']
                );
            }
            if (isset($request->reg_std3)) {
                $std_3 = reg_std::where('std_code', $request->reg_std3)->first();
                // $point_test50 = new point_test50();
                // $point_test50->project_id_point_test50 = $id;
                // $point_test50->id_instructor_point_test50 = $id_user->reg_tea_id;
                // $point_test50->point_test50 = $request->point_reg_std3;
                // $point_test50->reg_id_point_test50 = $std_3->id;
                // $point_test50->status_point_test50 = 'Waiting';
                // $point_test50->save();
                point_test50::updateOrCreate(
                    ['reg_id_point_test50'=>$std_3->id,'project_id_point_test50'=> $id,'id_instructor_point_test50'=>$id_user->reg_tea_id],
                    ['point_test50'=>$request->point_reg_std3,'status_point_test50'=>'Waiting']
                );
            }
            // return response()->json([$request->point_reg_std1,$std_1,$request->point_reg_std2,$std_2,$request->point_reg_std3,$std_3]);
            // $comment_test50 = new comment_test50();
            // $comment_test50->project_id_comemt_test50 = $id;
            // $comment_test50->id_instructor_comemt_test50 = $id_user->reg_tea_id;
            // $comment_test50->text_comemt_test50 = $request->commemt;
            // $comment_test50->action_comemt_test50 = $request->selecttopic;
            // $comment_test50->save();
           comment_test50::updateOrCreate(
                ['project_id_comemt_test50'=>$id,'id_instructor_comemt_test50'=>$id_user->reg_tea_id],
                ['text_comemt_test50'=>$request->commemt,'action_comemt_test50'=>$request->selecttopic]
            );

            $id_user = project_user::where('Project_id', $id)->get();
            foreach ($id_user as $key => $data) {
                $id_user2[] = user::where('reg_std_id', $data->id_reg_Std)->first();
            }

            foreach ($id_user2 as $key => $data) {
                $this->notifications_fun($data->id, 8, $id, 'ผลการประเมินสอบ50');
            }


            return redirect("/comment_test50");
            // return response()->json($id_user2);
        }
    }
    public function ResultsTest50($id)
    {

        $data_user = reg_std::where('user_id', $id)->first();
        $data_user_project = project_user::where('id_reg_Std', $data_user->id)->first();
        $data_project_instructors = project_instructor::where('Project_id', $data_user_project->Project_id)->get();
        $data_comment_test50 = comment_test50::where('project_id_comemt_test50', $data_user_project->Project_id)->get();

        // $data = project_instructor::join('comment_test50s', 'project_instructors.Project_id', 'comment_test50s.project_id_comemt_test50')
        // ->join('teachers', 'project_instructors.id_instructor', 'teachers.id')
        // ->select('comment_test50s.*','teachers.*')->where('Project_id', $data_user_project->Project_id)->get();

        // $data = Teacher::join('comment_test50s', 'teachers.id', 'comment_test50s.id_instructor_comemt_test50')
        // ->join('project_instructors','teachers.id','project_instructors.id_instructor')
        // ->select('comment_test50s.*', 'teachers.name_Instructor', 'teachers.Title_name_Instructor','project_instructors.Is_president')
        // ->where([['project_id_comemt_test50', $data_user_project->Project_id],['Project_id',$data_user_project->Project_id]])->get();

        $data = comment_test50::withTrashed()->join('teachers', 'comment_test50s.id_instructor_comemt_test50', 'teachers.id')
            ->join('project_instructors', 'teachers.id', 'project_instructors.id_instructor')
            ->select('comment_test50s.*', 'teachers.name_Instructor', 'teachers.Title_name_Instructor', 'project_instructors.Is_president')
            ->where([['project_id_comemt_test50', $data_user_project->Project_id], ['Project_id', $data_user_project->Project_id]])->get();

        // return response()->json($data);
        return view('info_word_template.AllResultsTest50', compact('data'));
    }
    public function remove_comment_test50($id1, $id2, $id3)
    {
        $id1 = comment_test50::find($id1);
        $test50 = test50::where('Project_id_test50', $id1->project_id_comemt_test50)->first();
        $point_test50_id1 = point_test50::where([['id_instructor_point_test50', $id1->id_instructor_comemt_test50], ['project_id_point_test50', $id1->project_id_comemt_test50]])->delete();
        $id1->delete();
        $test50->delete();


        $id2 = comment_test50::find($id2);
        $point_test50_id2 = point_test50::where([['id_instructor_point_test50', $id2->id_instructor_comemt_test50], ['project_id_point_test50', $id2->project_id_comemt_test50]])->delete();
        $id2->delete();

        $id3 = comment_test50::find($id3);
        $point_test50_id3 = point_test50::where([['id_instructor_point_test50', $id3->id_instructor_comemt_test50], ['project_id_point_test50', $id3->project_id_comemt_test50]])->delete();
        $id3->delete();


        // return response()->json($point_test50_id1);
        return redirect("/home");
        // return response()->json([$id1,$id2,$id3,$test50]);
    }
    public function comment_test100($id)
    {
        $user = Auth::user();
        if ($user->hasRole('Tea')) {
            $datas_instructor = project::join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $id)->get();
            $datas = project::select('projects.*')->where([['projects.id', '=', $id]])->get();
            $tableTest100_id = test100::where('Project_id_test100', '=', $id)->first();
            $datas_std = $this->DataTableController->data_project($id);
            // return view('projects.ProjectAdvisor.test100', compact('id', 'datas_std', 'datas_instructor', 'datas', 'tableTest100_id'));
            $data_reject_test = comment_test100::where([['project_id_comemt_test100',$id],['action_comemt_test100',2],['id_instructor_comemt_test100',Auth::user()->reg_tea_id]])->first();
            if(isset($data_reject_test)){
                $point_test100 = point_test100::where([['project_id_point_test100',$id],['id_instructor_point_test100',Auth::user()->reg_tea_id]])->get();
                // return response()->json($point_test50);
                return view('projects.ProjectAdvisor.test100', compact('id', 'datas_std', 'datas_instructor', 'datas', 'tableTest100_id','data_reject_test','point_test100'));
            }else{
                return view('projects.ProjectAdvisor.test100', compact('id', 'datas_std', 'datas_instructor', 'datas', 'tableTest100_id'));
            }
            

        }
    }
    public function comment_test100_page()
    {
        $user = Auth::user();
        if ($user->hasRole('Tea')) {
            $data_user = user::find($user->id);
            $data_project_instructors = project_instructor::where('id_instructor', $data_user->reg_tea_id)->get();
            // comment_test50::all();
            foreach ($data_project_instructors as $key => $data_test100s) {
                $check_test100 = test100::where('Project_id_test100', $data_test100s->Project_id)->first();
                $comment_test100 = comment_test100::where([['action_comemt_test100',1],['project_id_comemt_test100', $data_test100s->Project_id], ['id_instructor_comemt_test100', $data_user->reg_tea_id]])->first();
                if (isset($comment_test100)) {
                } else {
                    if (isset($check_test100)) {
                        $data_project[] = $check_test100;
                    }
                }
            }
            if (!empty($data_project)) {
                foreach ($data_project as $key => $data_project_instructor) {
                    $data_test100[] = project::where('id', $data_project_instructor->Project_id_test100)->first();
                    // $data_test50[] =$data_project_instructor;
                }
            } else {
                $data_test100 = null;
            }

            // return response()->json($data_test50);
            return view('projects.ProjectAdvisor.test100_page', compact('data_test100'));
        }
    }
    public function comment_test100_Datas(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->hasRole('Tea')) {

            $id_user = user::find($user->id);
            if (isset($request->reg_std1)) {
                $std_1 = reg_std::where('std_code', $request->reg_std1)->first();
                // $point_test100 = new point_test100();
                // $point_test100->project_id_point_test100 = $id;
                // $point_test100->id_instructor_point_test100 = $id_user->reg_tea_id;
                // $point_test100->point_test100 = $request->point_reg_std1;
                // $point_test100->reg_id_point_test100 = $std_1->id;
                // $point_test100->status_point_test100 = 'Waiting';
                // $point_test100->save();
                point_test100::updateOrCreate(
                    ['reg_id_point_test100'=>$std_1->id,'project_id_point_test100'=> $id,'id_instructor_point_test100'=> $id_user->reg_tea_id],
                    ['point_test100'=>$request->point_reg_std1,"status_point_test100" => "Waiting"]
                );
            }
            if (isset($request->reg_std2)) {
                $std_2 = reg_std::where('std_code', $request->reg_std2)->first();
                // $point_test100 = new point_test100();
                // $point_test100->project_id_point_test100 = $id;
                // $point_test100->id_instructor_point_test100 = $id_user->reg_tea_id;
                // $point_test100->point_test100 = $request->point_reg_std2;
                // $point_test100->reg_id_point_test100 = $std_2->id;
                // $point_test100->status_point_test100 = 'Waiting';
                // $point_test100->save();
                point_test100::updateOrCreate(
                    ['reg_id_point_test100'=>$std_2->id,'project_id_point_test100'=> $id,'id_instructor_point_test100'=>$id_user->reg_tea_id],
                    ['point_test100'=>$request->point_reg_std2,'status_point_test100'=>'Waiting']
                );
            }
            if (isset($request->reg_std3)) {
                $std_3 = reg_std::where('std_code', $request->reg_std3)->first();
                // $point_test100 = new point_test100();
                // $point_test100->project_id_point_test100 = $id;
                // $point_test100->id_instructor_point_test100 = $id_user->reg_tea_id;
                // $point_test100->point_test100 = $request->point_reg_std3;
                // $point_test100->reg_id_point_test100 = $std_3->id;
                // $point_test100->status_point_test100 = 'Waiting';
                // $point_test100->save();

                point_test100::updateOrCreate(
                    ['reg_id_point_test100'=>$std_3->id,'project_id_point_test100'=> $id,'id_instructor_point_test100'=>$id_user->reg_tea_id],
                    ['point_test100'=>$request->point_reg_std3,'status_point_test100'=>'Waiting']
                );
            }
            // $comment_test100 = new comment_test100();
            // $comment_test100->project_id_comemt_test100 = $id;
            // $comment_test100->id_instructor_comemt_test100 = $id_user->reg_tea_id;
            // $comment_test100->text_comemt_test100 = $request->commemt;
            // $comment_test100->action_comemt_test100 = $request->selecttopic;
            // $comment_test100->save();
            comment_test100::updateOrCreate(
                ['project_id_comemt_test100'=>$id,'id_instructor_comemt_test100'=>$id_user->reg_tea_id],
                ['text_comemt_test100'=>$request->commemt,'action_comemt_test100'=>$request->selecttopic]
            );

            $id_user = project_user::where('Project_id', $id)->get();
            foreach ($id_user as $key => $data) {
                $id_user2[] = user::where('reg_std_id', $data->id_reg_Std)->first();
            }

            foreach ($id_user2 as $key => $data) {
                $this->notifications_fun($data->id, 9, $id, 'ผลการประเมินสอบ100');
            }


            return redirect("/comment_test100");
            // return response()->json($id_user2);
        }
    }
    public function ResultsTest100($id)
    {

        $data_user = reg_std::where('user_id', $id)->first();
        $data_user_project = project_user::where('id_reg_Std', $data_user->id)->first();
        $data_project_instructors = project_instructor::where('Project_id', $data_user_project->Project_id)->get();
        $data_comment_test100 = comment_test100::where('project_id_comemt_test100', $data_user_project->Project_id)->get();

        // $data = project_instructor::join('comment_test50s', 'project_instructors.Project_id', 'comment_test50s.project_id_comemt_test50')
        // ->join('teachers', 'project_instructors.id_instructor', 'teachers.id')
        // ->select('comment_test50s.*','teachers.*')->where('Project_id', $data_user_project->Project_id)->get();

        // $data = Teacher::join('comment_test50s', 'teachers.id', 'comment_test50s.id_instructor_comemt_test50')
        // ->join('project_instructors','teachers.id','project_instructors.id_instructor')
        // ->select('comment_test50s.*', 'teachers.name_Instructor', 'teachers.Title_name_Instructor','project_instructors.Is_president')
        // ->where([['project_id_comemt_test50', $data_user_project->Project_id],['Project_id',$data_user_project->Project_id]])->get();

        $data = comment_test100::withTrashed()->join('teachers', 'comment_test100s.id_instructor_comemt_test100', 'teachers.id')
            ->join('project_instructors', 'teachers.id', 'project_instructors.id_instructor')
            ->select('comment_test100s.*', 'teachers.name_Instructor', 'teachers.Title_name_Instructor', 'project_instructors.Is_president')
            ->where([['project_id_comemt_test100', $data_user_project->Project_id], ['Project_id', $data_user_project->Project_id]])->get();

        // return response()->json($data);
        return view('info_word_template.AllResultsTest100', compact('data'));
    }
    public function remove_comment_test100($id1, $id2, $id3)
    {
        $id1 = comment_test100::find($id1);
        $test100 = test100::where('Project_id_test100', $id1->project_id_comemt_test100)->first();
        $point_test100_id1 = point_test100::where([['id_instructor_point_test100', $id1->id_instructor_comemt_test100], ['project_id_point_test100', $id1->project_id_comemt_test100]])->delete();
        $id1->delete();
        $test100->delete();

        $id2 = comment_test100::find($id2);
        $point_test100_id2 = point_test100::where([['id_instructor_point_test100', $id2->id_instructor_comemt_test100], ['project_id_point_test100', $id2->project_id_comemt_test100]])->delete();
        $id2->delete();

        $id3 = comment_test100::find($id3);
        $point_test100_id3 = point_test100::where([['id_instructor_point_test100', $id3->id_instructor_comemt_test100], ['project_id_point_test100', $id3->project_id_comemt_test100]])->delete();
        $id3->delete();

        // return response()->json($point_test100_id1);
        return redirect("/home");
        // return response()->json([$id1,$id2,$id3,$test50]);
    }
    public function CollectPoints()
    {
        $user = Auth::user();
        if ($user->hasRole('Admin')) {
            $datas = CompleteForm::join('projects', 'complete_forms.Project_id_CompleteForm', 'projects.id')->select('projects.*')->where([['complete_forms.status_CompleteForm', 'Successfully']])->get();

            return View('projects.CollectPoints_page', compact('datas'));
        } else {
            abort(404);
        }
    }
    public function CollectPointsForm($id)
    {
        $datas_instructor = DB::table('projects')
            ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
            ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
            ->select('teachers.*')->where('projects.id', '=', $id)->get();
        $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=',  $id]])->get();
        $datas_std = $this->DataTableController->data_project_collectPointsForm($id);
        $id_instructor = project_instructor::where('Project_id', $id)->get();

        // return response()->json($datas_std);
        return view('word-template.CollectPoints', compact('datas_std', 'datas_instructor', 'datas'));
    }

    public function wordExport_CollectPoints(Request $request, $id)
    {

        $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=',  $id]])->get();
        $datas_std = $this->DataTableController->data_project_collectPointsForm($id);
        $id_instructor = project_instructor::join('teachers', 'project_instructors.id_instructor', 'teachers.id')->select('teachers.*')->where('Project_id', $id)->get();

        $datas_project = project::join('test50s', 'projects.id', '=', 'test50s.Project_id_test50')
            ->join('test100s', 'projects.id', '=', 'test100s.Project_id_test100')
            ->select('test50s.date_test50', 'test100s.date_test100')
            ->where([
                ['projects.id', $id], ['Project_id_test50', $id],
                ['Project_id_test100', $id]
            ])->get();

        foreach ($request->input("code_id") as $hobby) {
            foreach ($datas_std as $key => $row_data) {
                foreach ($row_data as $key => $row) {
                    if ($hobby == $row[0][0]->std_code) {
                        $arrays[] = $row;
                    }
                }
            }
        }

        // return response()->json($arrays);
        $templateProcessor = new TemplateProcessor(storage_path('word-template/รายงานผลการสอบโครงงานคอมพิวเตอร์.docx'));


        $templateProcessor->setValue('std_1', $arrays[0][0][0]->name);
        $templateProcessor->setValue('std1',  substr($arrays[0][0][0]->std_code, -3));
        $templateProcessor->setValue('nick_name1', $arrays[0][0][0]->nick_name);
        $templateProcessor->setValue('code_std1', $arrays[0][0][0]->std_code);
        $templateProcessor->setValue('year_term1', $arrays[0][0][0]->year_term);
        $templateProcessor->setValue('pointtest50_11', $arrays[0][0][0]->point_test50);
        $templateProcessor->setValue('pointtest50_21', $arrays[0][1][0]->point_test50);
        $templateProcessor->setValue('pointtest50_31', $arrays[0][2][0]->point_test50);
        $templateProcessor->setValue('pointtest100_11',  $arrays[0][0][1]->point_test100);
        $templateProcessor->setValue('pointtest100_21',  $arrays[0][1][1]->point_test100);
        $templateProcessor->setValue('pointtest100_31',  $arrays[0][2][1]->point_test100);
        $templateProcessor->setValue('meam50_1', $meam50_1 = round(($arrays[0][0][0]->point_test50 + $arrays[0][1][0]->point_test50 + $arrays[0][2][0]->point_test50) / 3));
        $templateProcessor->setValue('meam100_1', $meam100_1 = round(($arrays[0][0][1]->point_test100 + $arrays[0][1][1]->point_test100 + $arrays[0][2][1]->point_test100) / 3));
        $templateProcessor->setValue('internship1', $request->Internship_score[0]);
        $templateProcessor->setValue('testintime1', $request->Test_in_time[0]);
        $templateProcessor->setValue('pres1', $request->presentations[0]);
        $templateProcessor->setValue('total1', $total1 =  $meam100_1 + $meam50_1 + $request->presentations[0] + $request->Test_in_time[0] + $request->Internship_score[0]);
        if ($total1 >= 80) {
            $templateProcessor->setValue('grade1', $grade = 'A');
        } else if ($total1 >= 75) {
            $templateProcessor->setValue('grade1', $grade = 'B+');
        } else if ($total1 >= 70) {
            $templateProcessor->setValue('grade1', $grade = 'B');
        } else if ($total1 >= 65) {
            $templateProcessor->setValue('grade1', $grade = 'C+');
        } else if ($total1 >= 60) {
            $templateProcessor->setValue('grade1', $grade = 'C');
        }

        $CollectPoints = new CollectPoints;
        $CollectPoints->Internship_score = $request->Internship_score[0];
        $CollectPoints->Test_in_time = $request->Test_in_time[0];
        $CollectPoints->presentations = $request->presentations[0];
        $CollectPoints->grade = $grade;
        $CollectPoints->reg_id_collect_points = $arrays[0][0][0]->id;
        $CollectPoints->project_id_collect_points = $id;
        $CollectPoints->save();

        if (!empty($arrays[1])) {
            $templateProcessor->setValue('std2',  substr($arrays[1][0][0]->std_code, -3));
            $templateProcessor->setValue('nick_name2', $arrays[1][0][0]->nick_name);
            $templateProcessor->setValue('std_2', $arrays[1][0][0]->name);
            $templateProcessor->setValue('code_std2', $arrays[1][0][0]->std_code);
            $templateProcessor->setValue('year_term2', $arrays[1][0][0]->year_term);

            $templateProcessor->setValue('pointtest50_12', $arrays[1][0][0]->point_test50);
            $templateProcessor->setValue('pointtest50_22', $arrays[1][1][0]->point_test50);
            $templateProcessor->setValue('pointtest50_32', $arrays[1][2][0]->point_test50);

            $templateProcessor->setValue('pointtest100_12',  $arrays[1][0][1]->point_test100);
            $templateProcessor->setValue('pointtest100_22',  $arrays[1][1][1]->point_test100);
            $templateProcessor->setValue('pointtest100_32',  $arrays[1][2][1]->point_test100);

            $templateProcessor->setValue('meam50_2', $meam50_2 = round(($arrays[1][0][0]->point_test50 + $arrays[1][1][0]->point_test50 + $arrays[1][2][0]->point_test50) / 3));
            $templateProcessor->setValue('meam100_2', $meam100_2 = round(($arrays[1][0][1]->point_test100 + $arrays[1][1][1]->point_test100 + $arrays[1][2][1]->point_test100) / 3));

            $templateProcessor->setValue('internship2', $request->Internship_score[1]);
            $templateProcessor->setValue('testintime2', $request->Test_in_time[1]);

            $templateProcessor->setValue('pres2', $request->presentations[1]);
            $templateProcessor->setValue('total2', $total2 = $meam50_2 + $meam100_2 + $request->presentations[1] + $request->Test_in_time[1] + $request->Internship_score[1]);
            if ($total2 >= 80) {
                $templateProcessor->setValue('grade2', $grade2 = 'A');
            } else if ($total2 >= 75) {
                $templateProcessor->setValue('grade2', $grade2 = 'B+');
            } else if ($total2 >= 70) {
                $templateProcessor->setValue('grade2', $grade2 = 'B');
            } else if ($total2 >= 65) {
                $templateProcessor->setValue('grade2', $grade2 = 'C+');
            } else if ($total2 >= 60) {
                $templateProcessor->setValue('grade2', $grade2 = 'C');
            }
            $CollectPoints = new CollectPoints;
            $CollectPoints->Internship_score = $request->Internship_score[1];
            $CollectPoints->Test_in_time = $request->Test_in_time[1];
            $CollectPoints->presentations = $request->presentations[1];
            $CollectPoints->grade = $grade2;
            $CollectPoints->reg_id_collect_points = $arrays[1][0][0]->id;
            $CollectPoints->project_id_collect_points = $id;
            $CollectPoints->save();
        } else {
            $templateProcessor->setValue('std2',  "");
            $templateProcessor->setValue('nick_name2', "");
            $templateProcessor->setValue('std_2', "");
            $templateProcessor->setValue('code_std2', "");
            $templateProcessor->setValue('year_term2', "");

            $templateProcessor->setValue('pointtest50_12', "");
            $templateProcessor->setValue('pointtest50_22', "");
            $templateProcessor->setValue('pointtest50_32', "");

            $templateProcessor->setValue('pointtest100_12',  "");
            $templateProcessor->setValue('pointtest100_22',  "");
            $templateProcessor->setValue('pointtest100_32', "");

            $templateProcessor->setValue('meam50_2', "");
            $templateProcessor->setValue('meam100_2', "");

            $templateProcessor->setValue('internship2', "");
            $templateProcessor->setValue('testintime2', "");

            $templateProcessor->setValue('pres2', "");
            $templateProcessor->setValue('total2', "");
            $templateProcessor->setValue('grade2', '');
        }
        if (!empty($arrays[2])) {
            $templateProcessor->setValue('std3',  substr($arrays[2][0][0]->std_code, -3));
            $templateProcessor->setValue('nick_name3', $arrays[2][0][0]->nick_name);
            $templateProcessor->setValue('std_3', $arrays[2][0][0]->name);
            $templateProcessor->setValue('code_std3', $arrays[2][0][0]->std_code);
            $templateProcessor->setValue('year_term3', $arrays[2][0][0]->year_term);

            $templateProcessor->setValue('pointtest50_13', $arrays[2][0][0]->point_test50);
            $templateProcessor->setValue('pointtest50_23', $arrays[2][1][0]->point_test50);
            $templateProcessor->setValue('pointtest50_33', $arrays[2][2][0]->point_test50);

            $templateProcessor->setValue('pointtest100_13',  $arrays[2][0][1]->point_test100);
            $templateProcessor->setValue('pointtest100_23',  $arrays[2][1][1]->point_test100);
            $templateProcessor->setValue('pointtest100_33',  $arrays[2][2][1]->point_test100);

            $templateProcessor->setValue('meam50_3', $meam50_3 = round(($arrays[2][0][0]->point_test50 + $arrays[2][1][0]->point_test50 + $arrays[2][2][0]->point_test50) / 3));
            $templateProcessor->setValue('meam100_3', $meam100_3 = round(($arrays[2][0][1]->point_test100 + $arrays[2][1][1]->point_test100 + $arrays[2][2][1]->point_test100) / 3));

            $templateProcessor->setValue('internship3', $request->Internship_score[2]);
            $templateProcessor->setValue('testintime3', $request->Test_in_time[2]);

            $templateProcessor->setValue('pres3', $request->presentations[2]);
            $templateProcessor->setValue('total3', $total3 = $meam50_3 + $meam100_3 + $request->presentations[2] + $request->Test_in_time[2] + $request->Internship_score[2]);
            if ($total3 >= 80) {
                $templateProcessor->setValue('grade3', $grade3 = 'A');
            } else if ($total3 >= 75) {
                $templateProcessor->setValue('grade3', $grade3 = 'B+');
            } else if ($total3 >= 70) {
                $templateProcessor->setValue('grade3', $grade3 = 'B');
            } else if ($total3 >= 65) {
                $templateProcessor->setValue('grade3', $grade3 = 'C+');
            } else if ($total3 >= 60) {
                $templateProcessor->setValue('grade3', $grade3 = 'C');
            }
            $CollectPoints = new CollectPoints;
            $CollectPoints->Internship_score = $request->Internship_score[2];
            $CollectPoints->Test_in_time = $request->Test_in_time[2];
            $CollectPoints->presentations = $request->presentations[2];
            $CollectPoints->grade = $grade3;
            $CollectPoints->reg_id_collect_points = $arrays[2][0][0]->id;
            $CollectPoints->project_id_collect_points = $id;
            $CollectPoints->save();
        } else {
            $templateProcessor->setValue('std3',  "");
            $templateProcessor->setValue('nick_name3', "");
            $templateProcessor->setValue('std_3', "");
            $templateProcessor->setValue('code_std3', "");
            $templateProcessor->setValue('year_term3', "");
            $templateProcessor->setValue('pointtest50_13', "");
            $templateProcessor->setValue('pointtest50_23', "");
            $templateProcessor->setValue('pointtest50_33', "");
            $templateProcessor->setValue('pointtest100_13',  "");
            $templateProcessor->setValue('pointtest100_23',  "");
            $templateProcessor->setValue('pointtest100_33', "");
            $templateProcessor->setValue('meam50_3', "");
            $templateProcessor->setValue('meam100_3', "");
            $templateProcessor->setValue('internship3', "");
            $templateProcessor->setValue('testintime3', "");
            $templateProcessor->setValue('pres3', "");
            $templateProcessor->setValue('total3', "");
            $templateProcessor->setValue('grade3', '');
        }

        $templateProcessor->setValue('name_chairman', $id_instructor[0]->Title_name_Instructor . $id_instructor[0]->name_Instructor);
        $templateProcessor->setValue('name_director1', $id_instructor[1]->Title_name_Instructor . $id_instructor[1]->name_Instructor);
        $templateProcessor->setValue('name_director2', $id_instructor[2]->Title_name_Instructor . $id_instructor[2]->name_Instructor);
        $templateProcessor->setValue('name_th', $datas[0]->name_th);
        $templateProcessor->setValue('name_eng', $datas[0]->name_en);

        $templateProcessor->setValue('date_test50', formatDateThai($datas_project[0]->date_test50));
        $templateProcessor->setValue('date_test100', formatDateThai($datas_project[0]->date_test100));
        $templateProcessor->setValue('date_now', formatDateThai(date("Y-m-d")));

        $fileName = storage_path("รายงานผลการสอบโครงงานคอมพิวเตอร์" . '.docx');
        $templateProcessor->saveAs($fileName);

        // return response()->json($datas[0]->name_th);
        return response()->download($fileName)->deleteFileAfterSend(true);
    }
    public function reject_project(Request $request, $id_Notifications, $id, $id_test)
    {

        $reject = new reject_test();
        $reject->project_id_reject_tests = $id;
        $reject->test_id = $id_test;
        // return response()->json(Auth::user());
        $reject->id_user_reject_tests = Auth::user()->id;
        $reject->comment_reject_tests = $request->reject;
        $reject->save();

        $sendToUser  =  project_user::where([['Project_id', $id]])->get();
        // $sendToUser  = User::where('reg_std_id',$id_reg->id_reg_Std)->first();
        if ($id_test == 1) {
            foreach ($sendToUser as $key => $itme) {
                $send  = User::where('reg_std_id', $itme->id_reg_Std)->first();
                $send->notify(new InvoicePaid(12, $id, 'คำแบบเสนอขอสอบ50ไม่ผ่าน กรุณาแก้ไข', Auth::user()));
            }
        }
        if ($id_test == 2) {
            foreach ($sendToUser as $key => $itme) {
                $send  = User::where('reg_std_id', $itme->id_reg_Std)->first();
                $send->notify(new InvoicePaid(12, $id, 'คำแบบเสนอขอสอบ100ไม่ผ่าน กรุณาแก้ไข', Auth::user()));
            }
        }
        if ($id_test == 3) {
            foreach ($sendToUser as $key => $itme) {
                $send  = User::where('reg_std_id', $itme->id_reg_Std)->first();
                $send->notify(new InvoicePaid(12, $id, 'ขออนุญาตเปลี่ยนแปลงหัวข้อโครงงานคอมพิวเตอร์ไม่ผ่าน กรุณาแก้ไข', Auth::user()));
            }
        }
        if ($id_test == 4) {
            foreach ($sendToUser as $key => $itme) {
                $send  = User::where('reg_std_id', $itme->id_reg_Std)->first();
                $send->notify(new InvoicePaid(12, $id, 'ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์ไม่ผ่าน กรุณาแก้ไข', Auth::user()));
            }
        }


        foreach (Auth::user()->unreadNotifications as $notification) {
            if ($notification->id == $id_Notifications) {
                // return response()->json($notification->id );
                $notification->markAsRead();
            } else {
            }
        }
        return redirect('/home');
    }
    public function reject_allow($id, $id_test)
    {
        // return response()->json([$id,$id_test]);
        $data_reject = reject_test::where([['project_id_reject_tests', $id], ['test_id', $id_test]])->get();
        if (isset($data_reject)) {
            reject_test::where([['project_id_reject_tests', $id], ['test_id', $id_test]])->delete();
        }
        if ($id_test == 1) {
            $test50 = test50::where('Project_id_test50', $id);
            if (isset($test50)) {
                test50::where('Project_id_test50', $id)->delete();
                return redirect('/home');
            } else {
                return redirect('/home');
            }
        } elseif ($id_test == 2) {
            $test100 = test100::where('Project_id_test100', $id)->get();
            if (isset($test100)) {
                test100::where('Project_id_test100', $id)->delete();
                return redirect('/home');
            } else {
                return redirect('/home');
            }
        } elseif ($id_test == 3) {
            $changetopic = changetopic::where('Project_id_changetopics', $id)->get();
        // return response()->json([$changetopic]);
            if (isset($changetopic)) {
                changetopic::where('Project_id_changetopics', $id)->delete();
                return redirect('/home');
            } else {
                return redirect('/home');
            }
        } elseif ($id_test == 4) {
            $ChangeBoard = ChangeBoard::where('Project_id_ChangeBoard', $id)->get();
            if (isset($ChangeBoard)) {
                ChangeBoard::where('Project_id_ChangeBoard', $id)->delete();
                return redirect('/home');
            } else {
                return redirect('/home');
            }
            return redirect('/home');
        }
    }
}
