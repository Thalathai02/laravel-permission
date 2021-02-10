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
                return view('home', compact('notification','data_topics_Dashboard', 'data_progress_Dashboard'));
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
                $notification  = $this->DataTableController->noti_data_allow_test50($id_stu_project[0]->Project_id,$datas_instructor[0]->id,$datas_instructor[1]->id,$datas_instructor[2]->id); 
                $data_topics_Dashboard = "เสนอขอสอบ50";
                $data_progress_Dashboard = $datas_std = $this->count_data_progress->count_data_progress(3);
                $datas_std = $this->DataTableController->data_project($id_stu_project[0]->Project_id);
                $test50_ProgressReport = ProgressReport_test50::where('Project_id_report_test50', $id_stu_project[0]->Project_id)->get();
                $test_100 = test100::where('Project_id_test100', $id_stu_project[0]->Project_id)->get();
                if (!empty($test_100[0]->id)) {
                    $notification  = $this->DataTableController->noti_data_allow_test100s($id_stu_project[0]->Project_id,$datas_instructor[0]->id,$datas_instructor[1]->id,$datas_instructor[2]->id); 
                    $data_topics_Dashboard = "เสนอขอสอบ100";
                    $data_progress_Dashboard = $datas_std = $this->count_data_progress->count_data_progress(5);
                    $test100_ProgressReport = ProgressReport_test100::where('Project_id_report_test100', $id_stu_project[0]->Project_id)->get();
                    $complete_forms = CompleteForm::where('Project_id_CompleteForm', $id_stu_project[0]->Project_id)->get();
                    if(!empty($complete_forms[0]->id)) {
                        $notification  = $this->DataTableController->noti_data_allow_complete_forms($id_stu_project[0]->Project_id,$datas_instructor[0]->id,$datas_instructor[1]->id,$datas_instructor[2]->id); 
                        $data_topics_Dashboard = "แบบขอส่งโครงงานฉบับสมบูรณ์";
                        $data_progress_Dashboard = $datas_std = $this->count_data_progress->count_data_progress(7);
                        return view('home', compact('notification','data_topics_Dashboard', 'data_progress_Dashboard', 'datas', 'datas_std', 'datas_instructor'));
                    } elseif (!empty($test100_ProgressReport[0]->id)) {
                        $notification  = $this->DataTableController->noti_data_allow_report_test100s($id_stu_project[0]->Project_id,$datas_instructor[0]->id,$datas_instructor[1]->id,$datas_instructor[2]->id); 
                        $data_topics_Dashboard = "รายงานการสอบความก้าวหน้า (สอบ100)";
                        $data_progress_Dashboard = $datas_std = $this->count_data_progress->count_data_progress(6);
                        $notification  = $this->DataTableController->noti_data_allow_test100s($id_stu_project[0]->Project_id,$datas_instructor[0]->id,$datas_instructor[1]->id,$datas_instructor[2]->id); 
                        return view('home', compact('notification','data_topics_Dashboard', 'data_progress_Dashboard', 'datas', 'datas_std', 'datas_instructor'));
                    }
                    return view('home', compact('notification','data_topics_Dashboard', 'data_progress_Dashboard', 'datas', 'datas_std', 'datas_instructor'));
                } elseif (!empty($test50_ProgressReport[0]->id)) {
                    $notification  = $this->DataTableController->noti_data_allow_report_test50s($id_stu_project[0]->Project_id,$datas_instructor[0]->id,$datas_instructor[1]->id,$datas_instructor[2]->id); 
                    $data_topics_Dashboard = "รายงานการสอบความก้าวหน้า (สอบ50)";
                    $data_progress_Dashboard = $datas_std = $this->count_data_progress->count_data_progress(4);
                    return view('home', compact('notification','data_topics_Dashboard', 'data_progress_Dashboard', 'datas', 'datas_std', 'datas_instructor'));
                }
                return view('home', compact('notification','data_topics_Dashboard', 'data_progress_Dashboard', 'datas', 'datas_std', 'datas_instructor'));
            } elseif (!empty($datas_instructor[0]->id)) {
                $notification = 3;
                $data_topics_Dashboard = "แต่งตั้งประธานและกรรมการแล้ว";
                $data_progress_Dashboard = $datas_std = $this->count_data_progress->count_data_progress(2);
                $datas_std = $this->DataTableController->data_project($id_stu_project[0]->Project_id);
                return view('home', compact('notification','data_topics_Dashboard', 'data_progress_Dashboard', 'datas', 'datas_std', 'datas_instructor'));
            } else {
                $notification = 3;
                $data_topics_Dashboard = "ส่งหัวข้อแล้ว รอแต่งตั้งประท่านกรรมการ";
                $data_progress_Dashboard = $datas_std = $this->count_data_progress->count_data_progress(1);
                $datas_std = $this->DataTableController->data_project($id_stu_project[0]->Project_id);
                return view('home', compact('notification','data_topics_Dashboard', 'data_progress_Dashboard', 'datas_std', 'datas'));
            }
        }
        if (Auth::user()->hasRole('Admin')) {
            $term = subject::pluck('year_term', 'id');
            return view('home',compact('term'));
        }
        return view('home');
    }
}
