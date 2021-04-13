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
use App\Http\Controllers\DataTableController;
use App\comment_test50;
use App\comment_test100;
use App\reject_test;
use App\notification;

class InfoWordTemplateController extends Controller
{
    protected $DataTableController;

    /**
     * Create a new controller instance.
     *
     * @return void
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
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
    public function checkForm($form, $formId, $id_Notifications)
    {
        // return response()->json($id_Notifications);
        // $this->test50($formId);
        

        if ($form == 1) {
            $tableTest50_id = test50::find($formId);
            $name_Instructor = Teacher::pluck('name_Instructor', 'id');
            if (Auth::user()->hasRole('Admin')) {
                $datas_instructor = DB::table('projects')
                    ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                    ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                    ->select('teachers.*')->where('projects.id', '=', $tableTest50_id->Project_id_test50)->get();

                $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $tableTest50_id->Project_id_test50]])->get();

                $datas_std = $this->DataTableController->data_project($tableTest50_id->Project_id_test50);

                $checkReader = notification::where('id',$id_Notifications)->first();
                // return response()->json($checkReader);
                if(isset($checkReader->read_at)){
                    abort(404);
                }


                return view('info_word_template.test50', compact('datas_std', 'datas_instructor', 'datas', 'name_Instructor', 'tableTest50_id', 'id_Notifications'));
            }
            if (Auth::user()->hasRole('Tea')) {
                $checkReader = notification::where('id',$id_Notifications)->first();
                // return response()->json($checkReader);
                if(isset($checkReader->read_at)){
                    abort(404);
                }
                $datas_instructor = DB::table('projects')
                    ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                    ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                    ->select('teachers.*')->where('projects.id', '=', $tableTest50_id->Project_id_test50)->get();

                $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $tableTest50_id->Project_id_test50]])->get();

                $datas_std = $this->DataTableController->data_project($tableTest50_id->Project_id_test50);

                return view('info_word_template.test50', compact('datas_std', 'datas_instructor', 'datas', 'name_Instructor', 'tableTest50_id', 'id_Notifications'));
            } else {
                abort(404);
            }
        }

        if ($form == 2) {
            $tableTest50_id = ProgressReport_test50::find($formId);
            $name_Instructor = Teacher::pluck('name_Instructor', 'id');

            if (Auth::user()->hasRole('Admin')) {

                $datas_instructor = DB::table('projects')
                    ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                    ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                    ->select('teachers.*')->where('projects.id', '=', $tableTest50_id->Project_id_report_test50)->get();

                $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $tableTest50_id->Project_id_report_test50]])->get();

                $datas_std = $this->DataTableController->data_project($tableTest50_id->Project_id_report_test50);
                $time_test50 = test50::where('Project_id_test50', $datas[0]->id)->get();

                // return response()->json($time_test50);
                return view('/info_word_template/ProgressReport_test50', compact('datas_std', 'datas_instructor', 'datas', 'name_Instructor', 'tableTest50_id', 'id_Notifications', 'time_test50'));
                // return view('/info_word_template/ProgressReport_test50', compact( 'datas_std', 'datas_instructor', 'datas', 'name_Instructor','time_test50'));                   
            }
            if (Auth::user()->hasRole('Tea')) {
                $datas_instructor = DB::table('projects')
                    ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                    ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                    ->select('teachers.*')->where('projects.id', '=', $tableTest50_id->Project_id_report_test50)->get();

                $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $tableTest50_id->Project_id_report_test50]])->get();

                $datas_std = $this->DataTableController->data_project($tableTest50_id->Project_id_report_test50);
                $time_test50 = test50::where('Project_id_test50', $datas[0]->id)->get();

                return view('/info_word_template/ProgressReport_test50', compact('datas_std', 'datas_instructor', 'datas', 'name_Instructor', 'tableTest50_id', 'id_Notifications', 'time_test50'));
            } else {
                abort(404);
            }
        }
        if ($form == 3) {
            $tableTest100_id = test100::find($formId);
            $name_Instructor = Teacher::pluck('name_Instructor', 'id');
            if (Auth::user()->hasRole('Admin')) {
                $checkReader = notification::where('id',$id_Notifications)->first();
                // return response()->json($checkReader);
                if(isset($checkReader->read_at)){
                    abort(404);
                }
                $datas_instructor = DB::table('projects')
                    ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                    ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                    ->select('teachers.*')->where('projects.id', '=', $tableTest100_id->Project_id_test100)->get();

                $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $tableTest100_id->Project_id_test100]])->get();

                $datas_std = $this->DataTableController->data_project($tableTest100_id->Project_id_test100);


                return view('info_word_template.test100', compact('datas_std', 'datas_instructor', 'datas', 'name_Instructor', 'tableTest100_id', 'id_Notifications'));
            }
            if (Auth::user()->hasRole('Tea')) {
                $checkReader = notification::where('id',$id_Notifications)->first();
                // return response()->json($checkReader);
                if(isset($checkReader->read_at)){
                    abort(404);
                }
                $datas_instructor = DB::table('projects')
                    ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                    ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                    ->select('teachers.*')->where('projects.id', '=', $tableTest100_id->Project_id_test100)->get();

                $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $tableTest100_id->Project_id_test100]])->get();

                $datas_std = $this->DataTableController->data_project($tableTest100_id->Project_id_test100);


                return view('info_word_template.test100', compact('datas_std', 'datas_instructor', 'datas', 'name_Instructor', 'tableTest100_id', 'id_Notifications'));
            } else {
                abort(404);
            }
        }
        if ($form == 4) {
            $tableTest100_id = ProgressReport_test100::find($formId);
            $name_Instructor = Teacher::pluck('name_Instructor', 'id');

            if (Auth::user()->hasRole('Admin')) {
                $datas_instructor = DB::table('projects')
                    ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                    ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                    ->select('teachers.*')->where('projects.id', '=', $tableTest100_id->Project_id_report_test100)->get();

                $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $tableTest100_id->Project_id_report_test100]])->get();

                $datas_std = $this->DataTableController->data_project($tableTest100_id->Project_id_report_test100);
                $time_test100 = test100::where('Project_id_test100', $datas[0]->id)->get();

                return view('/info_word_template/ProgressReport_test100', compact('datas_std', 'datas_instructor', 'datas', 'name_Instructor', 'tableTest100_id', 'id_Notifications', 'time_test100'));
                // return view('/info_word_template/ProgressReport_test50', compact( 'datas_std', 'datas_instructor', 'datas', 'name_Instructor','time_test50'));                   
            }
            if (Auth::user()->hasRole('Tea')) {
                $datas_instructor = DB::table('projects')
                    ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                    ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                    ->select('teachers.*')->where('projects.id', '=', $tableTest100_id->Project_id_report_test100)->get();

                $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $tableTest100_id->Project_id_report_test100]])->get();

                $datas_std = $this->DataTableController->data_project($tableTest100_id->Project_id_report_test100);
                $time_test100 = test100::where('Project_id_test100', $datas[0]->id)->get();

                return view('/info_word_template/ProgressReport_test100', compact('datas_std', 'datas_instructor', 'datas', 'name_Instructor', 'tableTest100_id', 'id_Notifications', 'time_test100'));
            } else {
                abort(404);
            }
        }
        if ($form == 5) {
            $tableCompleteForm_id = CompleteForm::find($formId);
            $name_Instructor = Teacher::pluck('name_Instructor', 'id');

            if (Auth::user()->hasRole('Admin')) {
                $datas_instructor = DB::table('projects')
                    ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                    ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                    ->select('teachers.*')->where('projects.id', '=', $tableCompleteForm_id->Project_id_CompleteForm)->get();

                $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $tableCompleteForm_id->Project_id_CompleteForm]])->get();

                $datas_std = $this->DataTableController->data_project($tableCompleteForm_id->Project_id_CompleteForm);
                $tableCompleteForm_id->status_CompleteForm = 'Successfully';
                $tableCompleteForm_id->save();

                return view('/info_word_template/CompleteForm', compact('datas_std', 'datas_instructor', 'datas', 'name_Instructor', 'tableCompleteForm_id', 'id_Notifications'));
                // return view('/info_word_template/ProgressReport_test50', compact( 'datas_std', 'datas_instructor', 'datas', 'name_Instructor','time_test50'));                   
            } else {
                abort(404);
            }
        }
        if ($form == 6) {
            $tableChangeBoard_id = ChangeBoard::find($formId);
            $name_Instructor = Teacher::pluck('name_Instructor', 'id');

            if (Auth::user()->hasRole('Admin')) {
                $datas_instructor = DB::table('projects')
                    ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                    ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                    ->select('teachers.*')->where('projects.id', '=', $tableChangeBoard_id->Project_id_ChangeBoard)->get();

                $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $tableChangeBoard_id->Project_id_ChangeBoard]])->get();

                $datas_std = $this->DataTableController->data_project($tableChangeBoard_id->Project_id_ChangeBoard);
                // return view('/word-template/ChangeBoard', compact( 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
                $new_name_president = Teacher::find($tableChangeBoard_id->new_name_president);
                $new_name_director1 = Teacher::find($tableChangeBoard_id->new_name_director1);
                $new_name_director2 = Teacher::find($tableChangeBoard_id->new_name_director2);
                return view('/info_word_template/ChangeBoard', compact('datas_std', 'datas_instructor', 'datas', 'name_Instructor', 'tableChangeBoard_id', 'id_Notifications', 'new_name_president', 'new_name_director1', 'new_name_director2'));
                // return view('/info_word_template/ProgressReport_test50', compact( 'datas_std', 'datas_instructor', 'datas', 'name_Instructor','time_test50'));                   
            }
            if (Auth::user()->hasRole('Tea')) {
                $datas_instructor = DB::table('projects')
                    ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                    ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                    ->select('teachers.*')->where('projects.id', '=', $tableChangeBoard_id->Project_id_ChangeBoard)->get();

                $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $tableChangeBoard_id->Project_id_ChangeBoard]])->get();

                $datas_std = $this->DataTableController->data_project($tableChangeBoard_id->Project_id_ChangeBoard);
                // return view('/word-template/ChangeBoard', compact( 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));
                $new_name_president = Teacher::find($tableChangeBoard_id->new_name_president);
                $new_name_director1 = Teacher::find($tableChangeBoard_id->new_name_director1);
                $new_name_director2 = Teacher::find($tableChangeBoard_id->new_name_director2);
                return view('/info_word_template/ChangeBoard', compact('datas_std', 'datas_instructor', 'datas', 'name_Instructor', 'tableChangeBoard_id', 'id_Notifications', 'new_name_president', 'new_name_director1', 'new_name_director2'));
                // return view('/info_word_template/ProgressReport_test50', compact( 'datas_std', 'datas_instructor', 'datas', 'name_Instructor','time_test50'));                   
            } else {
                abort(404);
            }
        }
        if ($form == 7) {
            $tablechangetopic_id = changetopic::find($formId);
            $name_Instructor = Teacher::pluck('name_Instructor', 'id');

            if (Auth::user()->hasRole('Admin')) {
                $datas_instructor = DB::table('projects')
                    ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                    ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                    ->select('teachers.*')->where('projects.id', '=', $tablechangetopic_id->Project_id_changetopics)->get();

                $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $tablechangetopic_id->Project_id_changetopics]])->get();

                $datas_std = $this->DataTableController->data_project($tablechangetopic_id->Project_id_changetopics);
                // return view('/word-template/ChangeBoard', compact( 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));

                return view('/info_word_template/ChangeTopic', compact('datas_std', 'datas_instructor', 'datas', 'name_Instructor', 'tablechangetopic_id', 'id_Notifications'));
                // return view('/info_word_template/ProgressReport_test50', compact( 'datas_std', 'datas_instructor', 'datas', 'name_Instructor','time_test50'));                   
            }
            if (Auth::user()->hasRole('Tea')) {
                $datas_instructor = DB::table('projects')
                    ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                    ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                    ->select('teachers.*')->where('projects.id', '=', $tablechangetopic_id->Project_id_changetopics)->get();

                $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $tablechangetopic_id->Project_id_changetopics]])->get();

                $datas_std = $this->DataTableController->data_project($tablechangetopic_id->Project_id_changetopics);
                // return view('/word-template/ChangeBoard', compact( 'datas_std', 'datas_instructor', 'datas', 'name_Instructor'));

                return view('/info_word_template/ChangeTopic', compact('datas_std', 'datas_instructor', 'datas', 'name_Instructor', 'tablechangetopic_id', 'id_Notifications'));
                // return view('/info_word_template/ProgressReport_test50', compact( 'datas_std', 'datas_instructor', 'datas', 'name_Instructor','time_test50'));                   
            } else {
                abort(404);
            }
        }
        if ($form == 8) {

            $name_Instructor = Teacher::pluck('name_Instructor', 'id');
            if (Auth::user()->hasRole('Std')) {
                $id = Auth::user()->id;
                $data_user = reg_std::where('user_id', $id)->first();
                $data_user_project = project_user::where('id_reg_Std', $data_user->id)->first();
                $data_project_instructors = project_instructor::where('Project_id', $formId)->get();
                $data_comment_test50 = comment_test50::where('project_id_comemt_test50', $formId)->get();

                // $data = project_instructor::join('comment_test50s', 'project_instructors.Project_id', 'comment_test50s.project_id_comemt_test50')
                // ->join('teachers', 'project_instructors.id_instructor', 'teachers.id')
                // ->select('comment_test50s.*','teachers.*')->where('Project_id', $data_user_project->Project_id)->get();



                $data = comment_test50::join('teachers', 'comment_test50s.id_instructor_comemt_test50', 'teachers.id')
                    ->join('project_instructors', 'teachers.id', 'project_instructors.id_instructor')
                    ->select('comment_test50s.*', 'teachers.name_Instructor', 'teachers.Title_name_Instructor', 'project_instructors.Is_president')
                    ->where([['project_id_comemt_test50', $data_user_project->Project_id], ['Project_id', $data_user_project->Project_id]])->get();


                // return response()->json($data);
                Auth::user()->unreadNotifications->markAsRead();
                foreach ($data as $key => $datas) {
                    $dataRaw[] = $datas;
                    // $Results=0;
                    $keys = $key;
                    $Results[] = $datas->action_comemt_test50;
                    $sumbit = array_sum($Results);
                }
                if ($key == 2) {
                    if ($sumbit == 3) {
                        $change_status = test50::where('Project_id_test50', $formId)->first();
                        $change_status->status_test50 = 'Successfully';
                        $change_status->save();
                    }
                }
                // return response()->json($dataRaw);
                return view('info_word_template.ResultsTest50', compact('data', 'keys', 'sumbit'));
            } else {
                abort(404);
            }
        }
        if ($form == 9) {
            $name_Instructor = Teacher::pluck('name_Instructor', 'id');
            if (Auth::user()->hasRole('Std')) {
                $id = Auth::user()->id;
                $data_user = reg_std::where('user_id', $id)->first();
                $data_user_project = project_user::where('id_reg_Std', $data_user->id)->first();
                $data_project_instructors = project_instructor::where('Project_id', $formId)->get();
                $data_comment_test100 = comment_test100::where('project_id_comemt_test100', $formId)->get();


                $data = comment_test100::join('teachers', 'comment_test100s.id_instructor_comemt_test100', 'teachers.id')
                    ->join('project_instructors', 'teachers.id', 'project_instructors.id_instructor')
                    ->select('comment_test100s.*', 'teachers.name_Instructor', 'teachers.Title_name_Instructor', 'project_instructors.Is_president')
                    ->where([['project_id_comemt_test100', $data_user_project->Project_id], ['Project_id', $data_user_project->Project_id]])->get();


                // return response()->json($data);
                Auth::user()->unreadNotifications->markAsRead();
                foreach ($data as $key => $datas) {
                    $dataRaw[] = $datas;
                    // $Results=0;
                    $keys = $key;
                    $Results[] = $datas->action_comemt_test100;
                    $sumbit = array_sum($Results);
                }
                if ($key == 2) {
                    if ($sumbit == 3) {
                        $change_status = test100::where('Project_id_test100', $formId)->first();
                        $change_status->status_test100 = 'Successfully';
                        $change_status->save();
                    }
                }
                // return response()->json($dataRaw);
                return view('info_word_template.ResultsTest100', compact('data', 'keys', 'sumbit'));
            } else {
                abort(404);
            }
        }
        if ($form == 10) {
            if (Auth::user()->hasRole('Std')) {
                $id = Auth::user()->id;
//ส่งคืนเอกสารให้นักศึกษา
                Auth::user()->unreadNotifications->markAsRead();
                if (project::where([['status', 'reject'], ['id', $formId]])->first()) {
                    $id_reg = reg_std::where('user_id', $id)->get();
                    $id_reg_Std = project_user::where('id_reg_Std',  $formId)->get();
                    //  return response()->json($id_reg_Std[0]->id);
                    $datas_instructor = DB::table('projects')
                        ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                        ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                        ->select('teachers.*')->where('projects.id', '=',  $formId)->get();

                    $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=',  $formId]])->get();

                    // $datas_std = $this->DataTableController->data_project($id_reg_Std[0]->id);
                    $datas_std = DB::table('projects')
                        ->join('project_users', 'projects.id', '=', 'project_users.Project_id')
                        ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                        ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
                        ->select('reg_stds.*', 'project__files.*')->where([['projects.id', '=',  $formId], ['project_users.deleted_at', null]])->get();
                    return view('projects.Edit_Project.index', compact('id', 'datas_std', 'datas_instructor', 'datas'));

                    // return response()->json($data);
                } else {
                    abort(404);
                }
            } else {
                abort(404);
            }
        }
        if ($form == 11) {
            //เมื่อโปรเจคผ่านเเล้วให้แจ้งเตือนกับนักศึกษา
            if (Auth::user()->hasRole('Std')) {
                $id = Auth::user()->id;

                Auth::user()->unreadNotifications->markAsRead();
                $mydata = User::find($id);
                $data_reg1 = reg_std::where('user_id', $mydata->id)->get();
                $id_stu_project = project_user::query()->where('id_reg_Std', $data_reg1[0]->id)->get();       
                $datas_instructor = DB::table('projects')
                    ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                    ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                    ->select('teachers.*')->where('projects.id', '=',$formId)->get();
                $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=',  $formId]])->get();
                $user = Auth::user();
        
                // if( Auth::user()->unreadNotifications->markAsRead()){
                   
                //     abort(404);
                // }

                if (!empty($datas_instructor[0]->id)) {
                    $datas_std = $this->DataTableController->data_project($formId);
                    return view('projects.info_project', compact('datas', 'datas_std', 'datas_instructor'));
                } else {
                    $datas_std = $this->DataTableController->data_project($formId);
                    return view('projects.info_project', compact('datas_std', 'datas'));
                }
            } else {
                abort(404);
            }
        }
        if ($form == 12) {
            //เมื่อโปรเจดไม่ผ่านจะแสดงเป็นเหตุผลว่าทำไมไม่ผ่าน
            if (Auth::user()->hasRole('Std')) {
                $id = Auth::user()->id;

                Auth::user()->unreadNotifications->markAsRead();
              
                $mydata = User::find($id);
                $data_reg1 = reg_std::where('user_id', $mydata->id)->first();
                $data_project = reject_test::join('users','reject_tests.id_user_reject_tests','users.id')
                ->select('reject_tests.*','users.name')
                ->where([['reject_tests.project_id_reject_tests',$formId],['reject_tests.deleted_at',null]])
                ->get();
                $datas_instructor = project_instructor::where('Project_id',$formId)->get();
                    // return response()->json($data_project);

                if($data_project == "[]"){
                    Auth::user()->unreadNotifications->markAsRead();
                    abort(404);
                }
                // return response()->json($data_project[0]->test_id);

                // return response()->json($id_user);
                if($data_project[0]->test_id == 1){
                    $test50=test50::where('Project_id_test50',$formId)->first();
                    // return response()->json($test50->Project_id_test50);
                    $notification  = $this->DataTableController->noti_data_allow_test50($test50->Project_id_test50, $datas_instructor[0]->id_instructor, $datas_instructor[1]->id_instructor, $datas_instructor[2]->id_instructor);
                }elseif($data_project[0]->test_id == 2){
                    $test100=test100::where('Project_id_test100',$formId)->first();
                    // return response()->json($test50->Project_id_test50);
                    $notification  = $this->DataTableController->noti_data_allow_test100s($test100->Project_id_test100, $datas_instructor[0]->id_instructor, $datas_instructor[1]->id_instructor, $datas_instructor[2]->id_instructor);
                }

                return view('info_word_template.reject_project_test',compact('data_project','notification'));
                // return response()->json($notification);
                
            } else {
                abort(404);
            }
        }
        // return response()->json($tableTest50_id->Project_id_test50 );
    }
    public function download($form, $status, $file)
    {
        // return response()->json([
        //     $year,
        //     $term,
        //    $file ,
        //     ]);

        // return response()->json($form);

        return response()->download(storage_path("/app/{$form}/{$file}"));
    }
    public function markAsRead($id)
    {

        foreach (Auth::user()->unreadNotifications as $notification) {

            if ($notification->id == $id) {
                // return response()->json($notification->id );
                $notification->markAsRead();
                return back();
            } else {
            }
        }
        // return response()->json($id );
    }
}
