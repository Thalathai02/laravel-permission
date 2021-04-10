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

class HomeController extends Controller
{
    protected $DataTableController;
    protected $count_data_progress;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DataTableController $DataTableController, DataTableController $count_data_progress)
    {
        $this->middleware('auth');
        $this->DataTableController = $DataTableController;
        $this->count_data_progress = $count_data_progress;
        // $this->noti_data_allow_test50 = $noti_data_allow_test50;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $data_progress_Dashboard = $datas_std = $this->count_data_progress->count_data_progress(0);
        // $a = 100;
        // return response()->json($data_progress_Dashboard);

        // return response()->json(Auth::user()->reg_std);
        if (Auth::user()->hasRole('Std')) {
            $id = Auth::user()->id;
            $mydata = User::find($id);
            $data_reg1 = reg_std::where('user_id', $mydata->id)->get();
            $id_stu_project = project_user::query()->where('id_reg_Std', $data_reg1[0]->id)->get();
            //    $notification  = $this->DataTableController->noti_data_allow_test50($id_stu_project[0]->Project_id);

            if ($id_stu_project == '[]') {
                $data_topics_Dashboard = "ยังไม่ส่งหัวข้อ";
                $notification = 3;
                $data_progress_Dashboard = $datas_std = $this->count_data_progress->count_data_progress(0);
                return view('home', compact('notification', 'data_topics_Dashboard', 'data_progress_Dashboard'));
                // return response()->json($id_stu_project );
            }
            $test_50 = test50::where('Project_id_test50', $id_stu_project[0]->Project_id)->get();
            $datas_instructor = DB::table('projects')
                ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $id_stu_project[0]->Project_id)->get();
            $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=',  $id_stu_project[0]->Project_id]])->get();
            $user = Auth::user();
            // return response()->json($test_50);
            // $notification  = $this->DataTableController->noti_data_allow_test50($id_stu_project[0]->Project_id,$datas_instructor[0]->id,$datas_instructor[1]->id,$datas_instructor[2]->id); 
            // return response()->json($notification);
            if (!empty($test_50[0]->id)) {
                $notification  = $this->DataTableController->noti_data_allow_test50($id_stu_project[0]->Project_id, $datas_instructor[0]->id, $datas_instructor[1]->id, $datas_instructor[2]->id);
                $data_topics_Dashboard = "เสนอขอสอบ50";
                $data_progress_Dashboard = $datas_std = $this->count_data_progress->count_data_progress(3);
                $datas_std = $this->DataTableController->data_project($id_stu_project[0]->Project_id);
                $test50_ProgressReport = ProgressReport_test50::where('Project_id_report_test50', $id_stu_project[0]->Project_id)->get();
                $test_100 = test100::where('Project_id_test100', $id_stu_project[0]->Project_id)->get();
                if (!empty($test_100[0]->id)) {
                    $notification  = $this->DataTableController->noti_data_allow_test100s($id_stu_project[0]->Project_id, $datas_instructor[0]->id, $datas_instructor[1]->id, $datas_instructor[2]->id);
                    $data_topics_Dashboard = "เสนอขอสอบ100";
                    $data_progress_Dashboard = $datas_std = $this->count_data_progress->count_data_progress(5);
                    $test100_ProgressReport = ProgressReport_test100::where('Project_id_report_test100', $id_stu_project[0]->Project_id)->get();
                    $complete_forms = CompleteForm::where('Project_id_CompleteForm', $id_stu_project[0]->Project_id)->get();
                    if (!empty($complete_forms[0]->id)) {
                        $notification  = $this->DataTableController->noti_data_allow_complete_forms($id_stu_project[0]->Project_id, $datas_instructor[0]->id, $datas_instructor[1]->id, $datas_instructor[2]->id);
                        $data_topics_Dashboard = "แบบขอส่งโครงงานฉบับสมบูรณ์";
                        $data_progress_Dashboard = $datas_std = $this->count_data_progress->count_data_progress(7);
                        return view('home', compact('notification', 'data_topics_Dashboard', 'data_progress_Dashboard', 'datas', 'datas_std', 'datas_instructor'));
                    } elseif (!empty($test100_ProgressReport[0]->id)) {
                        $notification  = $this->DataTableController->noti_data_allow_report_test100s($id_stu_project[0]->Project_id, $datas_instructor[0]->id, $datas_instructor[1]->id, $datas_instructor[2]->id);
                        $data_topics_Dashboard = "รายงานการสอบความก้าวหน้า (สอบ100)";
                        $data_progress_Dashboard = $datas_std = $this->count_data_progress->count_data_progress(6);
                        return view('home', compact('notification', 'data_topics_Dashboard', 'data_progress_Dashboard', 'datas', 'datas_std', 'datas_instructor'));
                    }
                    return view('home', compact('notification', 'data_topics_Dashboard', 'data_progress_Dashboard', 'datas', 'datas_std', 'datas_instructor'));
                } elseif (!empty($test50_ProgressReport[0]->id)) {
                    $notification  = $this->DataTableController->noti_data_allow_report_test50s($id_stu_project[0]->Project_id, $datas_instructor[0]->id, $datas_instructor[1]->id, $datas_instructor[2]->id);
                    $data_topics_Dashboard = "รายงานการสอบความก้าวหน้า (สอบ50)";
                    $data_progress_Dashboard = $datas_std = $this->count_data_progress->count_data_progress(4);
                    return view('home', compact('notification', 'data_topics_Dashboard', 'data_progress_Dashboard', 'datas', 'datas_std', 'datas_instructor'));
                }

                return view('home', compact('notification', 'data_topics_Dashboard', 'data_progress_Dashboard', 'datas', 'datas_std', 'datas_instructor'));
            } elseif (!empty($datas_instructor[0]->id)) {
                $notification = 3;
                $data_topics_Dashboard = "แต่งตั้งประธานและกรรมการแล้ว";
                $data_progress_Dashboard = $datas_std = $this->count_data_progress->count_data_progress(2);
                $datas_std = $this->DataTableController->data_project($id_stu_project[0]->Project_id);
                return view('home', compact('notification', 'data_topics_Dashboard', 'data_progress_Dashboard', 'datas', 'datas_std', 'datas_instructor'));
            } else {
                $notification = 3;
                $data_topics_Dashboard = "ส่งหัวข้อแล้ว รอแต่งตั้งประท่านกรรมการ";
                $data_progress_Dashboard = $datas_std = $this->count_data_progress->count_data_progress(1);
                $datas_std = $this->DataTableController->data_project($id_stu_project[0]->Project_id);
                return view('home', compact('notification', 'data_topics_Dashboard', 'data_progress_Dashboard', 'datas_std', 'datas'));
            }
        }
        if (Auth::user()->hasRole('Admin')) {
            $term = subject::orderBy('id','desc')->pluck('year_term', 'id');
            $term_last = subject::orderBy('id','desc')->get();
            $project = project::where([['projects.status', 'check'],['subject_id',$term_last[0]->id]])->get();

            $test50 = test50::join('projects','test50s.Project_id_test50','projects.id')
            ->where([['test50s.status_test50', 'Waiting'],['projects.subject_id',$term_last[0]->id]])->select('test50s.*','projects.*')->get();

            $test100 = test100::join('projects','test100s.Project_id_test100','projects.id')
            ->where([['test100s.status_test100', 'Waiting'],['projects.subject_id',$term_last[0]->id]])->select('test100s.*','projects.*')->get();

            $CompleteForm = CompleteForm::join('projects','complete_forms.Project_id_CompleteForm','projects.id')
            ->where([['status_CompleteForm', 'Waiting'],['projects.subject_id',$term_last[0]->id]])->select('complete_forms.*','projects.*')->get();

            $Successfully_project = project::where([['projects.status', 'Successfully'],['subject_id',$term_last[0]->id]])->get();

            // return response()->json($test50);
            return view('home', compact('term','project','test50','test100','CompleteForm','Successfully_project','term_last'));
        }
        if (Auth::user()->hasRole('Tea')) {
            $user = Auth::user();
            $data_subject = project_instructor::where('id_instructor', 'LIKE', $user->reg_tea_id)->get();
            $datas = project::join('project_instructors', 'projects.id', 'project_instructors.Project_id')->select('projects.*')->where([['project_instructors.id_instructor', $user->reg_tea_id], ['projects.status', 'Check']])->paginate(5);
            $data_test50 = test50::join('projects', 'test50s.Project_id_test50', 'projects.id')
                ->join('project_instructors', 'projects.id', 'project_instructors.Project_id')->select('projects.*')->where([['project_instructors.id_instructor', $user->reg_tea_id], ['test50s.status_test50', 'Waiting']])->paginate(5);
            $data_test100 = test100::join('projects', 'test100s.Project_id_test100', 'projects.id')
                ->join('project_instructors', 'projects.id', 'project_instructors.Project_id')->select('projects.*')->where([['project_instructors.id_instructor', $user->reg_tea_id], ['test100s.status_test100', 'Waiting']])->paginate(5);

            // return response()->json($data_test50);
            //Waiting
            //Successfully
            $data_CompleteForm = CompleteForm::join('projects', 'complete_forms.Project_id_CompleteForm', 'projects.id')
                ->join('project_instructors', 'projects.id', 'project_instructors.Project_id')->select('projects.*')->where([['project_instructors.id_instructor', $user->reg_tea_id], ['complete_forms.status_CompleteForm', 'Waiting']])->paginate(5);
            return view('home', compact('datas', 'data_test50', 'data_test100','data_CompleteForm'));
        }

        return view('home');
    }
    public function search_project(Request $request)
    { 
        // return response()->json($request->subject);
        $term = subject::orderBy('id','desc')->pluck('year_term', 'id');
        $term_last = subject::where('id',$request->subject)->get();
        $project = project::where([['projects.status', 'check'],['subject_id',$request->subject]])->get();

        $test50 = test50::join('projects','test50s.Project_id_test50','projects.id')
        ->where([['test50s.status_test50', 'Waiting'],['projects.subject_id',$request->subject]])->select('test50s.*','projects.*')->get();

        $test100 = test100::join('projects','test100s.Project_id_test100','projects.id')
        ->where([['test100s.status_test100', 'Waiting'],['projects.subject_id',$request->subject]])->select('test100s.*','projects.*')->get();

        $CompleteForm = CompleteForm::join('projects','complete_forms.Project_id_CompleteForm','projects.id')
        ->where([['status_CompleteForm', 'Waiting'],['projects.subject_id',$request->subject]])->select('complete_forms.*','projects.*')->get();

        $Successfully_project = project::where([['projects.status', 'Successfully'],['subject_id',$request->subject]])->get();

        // return response()->json($test50);
        return view('home', compact('term','project','test50','test100','CompleteForm','Successfully_project','term_last'));
   }
}
