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


                return view('info_word_template.test50', compact('datas_std', 'datas_instructor', 'datas', 'name_Instructor', 'tableTest50_id', 'id_Notifications'));
            }
            if (Auth::user()->hasRole('Tea')) {
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
            $tableTest50_id = test50::find($formId);
            $name_Instructor = Teacher::pluck('name_Instructor', 'id');

            if (Auth::user()->hasRole('Admin')) {
                $datas_instructor = DB::table('projects')
                    ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                    ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                    ->select('teachers.*')->where('projects.id', '=', $tableTest50_id->Project_id_test50)->get();

                $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $tableTest50_id->Project_id_test50]])->get();

                $datas_std = $this->DataTableController->data_project($tableTest50_id->Project_id_test50);
                $time_test50 = test50::where('Project_id_test50', $datas[0]->id)->get();

                return view('/info_word_template/ProgressReport_test50', compact('datas_std', 'datas_instructor', 'datas', 'name_Instructor', 'tableTest50_id', 'id_Notifications', 'time_test50'));
                // return view('/info_word_template/ProgressReport_test50', compact( 'datas_std', 'datas_instructor', 'datas', 'name_Instructor','time_test50'));                   
            }
            if (Auth::user()->hasRole('Tea')) {
                $datas_instructor = DB::table('projects')
                    ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                    ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                    ->select('teachers.*')->where('projects.id', '=', $tableTest50_id->Project_id_test50)->get();

                $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $tableTest50_id->Project_id_test50]])->get();

                $datas_std = $this->DataTableController->data_project($tableTest50_id->Project_id_test50);
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
                $datas_instructor = DB::table('projects')
                    ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                    ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                    ->select('teachers.*')->where('projects.id', '=', $tableTest100_id->Project_id_test100)->get();

                $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $tableTest100_id->Project_id_test100]])->get();

                $datas_std = $this->DataTableController->data_project($tableTest100_id->Project_id_test100);


                return view('info_word_template.test100', compact('datas_std', 'datas_instructor', 'datas', 'name_Instructor', 'tableTest100_id', 'id_Notifications'));
            }
            if (Auth::user()->hasRole('Tea')) {
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
            $tableTest100_id = test100::find($formId);
            $name_Instructor = Teacher::pluck('name_Instructor', 'id');

            if (Auth::user()->hasRole('Admin')) {
                $datas_instructor = DB::table('projects')
                    ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                    ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                    ->select('teachers.*')->where('projects.id', '=', $tableTest100_id->Project_id_test100)->get();

                $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $tableTest100_id->Project_id_test100]])->get();

                $datas_std = $this->DataTableController->data_project($tableTest100_id->Project_id_test100);
                $time_test100 = test100::where('Project_id_test100', $datas[0]->id)->get();

                return view('/info_word_template/ProgressReport_test100', compact('datas_std', 'datas_instructor', 'datas', 'name_Instructor', 'tableTest100_id', 'id_Notifications', 'time_test100'));
                // return view('/info_word_template/ProgressReport_test50', compact( 'datas_std', 'datas_instructor', 'datas', 'name_Instructor','time_test50'));                   
            }
            if (Auth::user()->hasRole('Tea')) {
                $datas_instructor = DB::table('projects')
                    ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                    ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                    ->select('teachers.*')->where('projects.id', '=', $tableTest100_id->Project_id_test100)->get();

                $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $tableTest100_id->Project_id_test100]])->get();

                $datas_std = $this->DataTableController->data_project($tableTest100_id->Project_id_test100);
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
            $tablechangetopic_id = changetopic::find($formId);
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

                $data = Teacher::join('comment_test50s', 'teachers.id', 'comment_test50s.id_instructor_comemt_test50')
                    ->join('project_instructors', 'teachers.id', 'project_instructors.id_instructor')
                    ->select('comment_test50s.*', 'teachers.*', 'project_instructors.*')
                    ->where([['project_id_comemt_test50', $formId],['Project_id',$formId]])->get();
                    

                // return response()->json($data);
                Auth::user()->unreadNotifications->markAsRead();
                return view('info_word_template.ResultsTest50', compact('data'));
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
        return response()->download(storage_path("/app/{$form}/{$status}/{$file}"));
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
