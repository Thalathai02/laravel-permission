<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\reg_std;
use App\project;
use App\Teacher;
use App\subject;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Project_Instructor;
use App\project_user;
use App\subject_student;
use Illuminate\Support\Facades\Storage;
use App\Project_File;
use http\Env\Response;
use SebastianBergmann\CodeCoverage\Report\Xml\Project as XmlProject;
use App\Http\Controllers\DataTableController;
use Illuminate\Support\Facades\Auth;
use App\Notifications\InvoicePaid;
use App\reject_test;
use App\CollectPoints;
use PhpOffice\PhpWord\TemplateProcessor;
use App\test100;
use App\test50;
use App\ProgressReport_test100;
use App\ProgressReport_test50;
use App\CompleteForm;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


class CheckProjectController extends Controller
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
    public function index(Request $request)
    {
        $user = $request->user();
        $data_subject = $request->get(
            'subject'
        );

        if ($user->hasRole('Admin')) {
            $datas = project::where('subject_id', $data_subject)->orderBy('id', 'ASC')->get();
            // return response()->json($datas);
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
            ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
            ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
            ->select('teachers.*')->where('projects.id', '=', $id)->get();
        $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=', $id]])->get();
        $user = $request->user();
        if (!empty($datas_instructor[0]->id)) {
            $datas_std = $this->DataTableController->data_project($id);
            return view('projects.info_project', compact('datas', 'datas_std', 'datas_instructor'));
        } else {
            $datas_std = $this->DataTableController->data_project($id);
            // return response()->json($datas_std);
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
                ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $id)->get();
            // return response()->json([
            //     'id' => $datas1
            // ]);

            $name_Instructor = Teacher::pluck('name_Instructor', 'id');
            if (empty($datas1)) {

                $datas = DB::table('projects')
                    ->join('project_users', 'projects.id', '=', 'project_users.Project_id')
                    ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
                    ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')


                    ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
                    ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
                    ->select('projects.*', 'project_users.*', 'reg_stds.*', 'teachers.*', 'project__files.*')->where([
                        ['projects.id', '=', $id], ['projects.deleted_at', null],
                        ['project_users.deleted_at', null],
                        ['project__files.status_file_path', '=', 'Waiting']
                    ])->get();
                return view('projects.instructor_project', compact('datas', 'name_Instructor'));
            } else {
                $datas = DB::table('projects')
                    ->join('project_users', 'projects.id', '=', 'project_users.Project_id')
                    ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                    ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
                    ->select('projects.*', 'project_users.*', 'reg_stds.*', 'project__files.*')->where([['projects.id', '=', $id], ['project_users.deleted_at', null], ['projects.deleted_at', null], ['project__files.status_file_path', '=', 'Waiting']])->get();
                return view('projects.instructor_project', compact('datas', 'name_Instructor'));
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
            $project = project::find($id);
            $project->status = 'Check';
            $project->name_mentor = $request->name_mentor;
            $project->save();
            // project::updateOrCreate(
            //     ['id' => $id, 'name_mentor' => $request->name_mentor],
            //     ['name_mentor' => $request->name_mentor]
            // );

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

            // return response()->json([
            //     'id' => $id,
            //     'reg_1' => $name_president,
            //     'reg_2' => $name_director1,
            //     'reg_3' => $name_director2 ,

            // ]);
            return redirect('/Selection_yearCheck_Project');
        } else {
            abort(404);
        }
    }
    public function Database_Project_instructor($id, $table, $data, $action, $is_action)
    {
        DB::table('project_instructors')->updateOrInsert([$table => $data[0]->id, "Project_id" => $id, $action => $is_action]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->validate([
            'reject' => 'required',
        ]);
        $id_reg  =  project_user::where([['Project_id', $id], ['isHead', '1']])->first();

        project::where('id', '=', $id)->update(['status' => "reject", 'because_reject' => $request->reject]);
        DB::table('project__files')->where('id', '=', $id)->update(['status_file_path' => "reject"]);
        $sendToUser  =  project_user::where([['Project_id', $id]])->get();

        $sendToUser  = User::where('reg_std_id', $id_reg->id_reg_Std)->first();
        // return response()->json($sendToUser);
        $sendToUser->notify(new InvoicePaid(10, $id, 'โครงานของคุณไม่ผ่าน กรุณาแก้ไข', Auth::user()));
        return back();
    }

    public function download($year, $term, $file)
    {
        // return response()->json([
        //     $year,
        //     $term,
        //    $file ,
        //     ]);
        return response()->download(storage_path('/app/' . $year . '/' . $term . '/' . $file));
        // return Storage::download($file, $file, '/app/Waiting/' . $year . '/' . $term . '/');
    }
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $data = reg_std::where('std_code', 'LIKE', $request->reg_std . '%')->get();
            $check_data=project_user::where('id_reg_Std',$data[0]->id )->first();

            $output = '';
            if (count($data) > 0) {
                foreach ($data as $row) {
                    if (isset($check_data)){
                        $output = '<p style="color:red;">' . $row->name .' มีโครงงานแล้ว'. '</p>';
                    }elseif(!isset($check_data)){
                        $output = '<p>' . 'ชื่อ ' . $row->name . '</p>';
                    }
                }
            } else {
                $output .= '<p>' . 'No results' . '</p>';
            }
            return $output;
        }
    }
    public function info_project($id)
    {
        $datas_instructor = DB::table('projects')
            ->join('project_instructors', 'projects.id', '=', 'project_instructors.Project_id')
            ->join('teachers', 'project_instructors.ID_Instructor', '=', 'teachers.id')
            ->select('teachers.*')->where('projects.id', '=', $id)->get();
        $datas = DB::table('projects')->select('projects.*')->where([['projects.id', '=',  $id]])->get();
        $datas_std = $this->DataTableController->data_project($id);

        $test50 = test50::where('Project_id_test50', $id)->first();
        $report_50 = ProgressReport_test50::where('Project_id_report_test50', $id)->first();

        $test100 = test100::where('Project_id_test100', $id)->first();
        $report_100 = ProgressReport_test100::where('Project_id_report_test100', $id)->first();

        $complete = CompleteForm::where('Project_id_CompleteForm', $id)->first();

        return view('projects.Onlyinfo_project', compact('datas', 'datas_std', 'datas_instructor', 'test50', 'report_50', 'report_100', 'test100', 'complete'));
        // return response()->json($test50);
    }
    public function Selection_year()
    {
        $term = subject::orderBy('id', 'desc')->pluck('year_term', 'id');
        // return response()->json($term);
        return view('projects.Selection_year_Check_Project', compact('term'));
    }
    public function success_check($id)
    {
        $sendToUser  =  project_user::where([['Project_id', $id]])->get();
        // $sendToUser  = User::where('reg_std_id',$id_reg->id_reg_Std)->first();

        foreach ($sendToUser as $key => $itme) {
            $send  = User::where('reg_std_id', $itme->id_reg_Std)->first();
            $send->notify(new InvoicePaid(11, $id, 'โครงานผ่านการตรวจสอบแล้ว รอการแต่งตั้งกรรมการ', Auth::user()));
        }
        // return response()->json($send);
        // $sendToUser->notify(new InvoicePaid(11, $id, 'โครงานผ่านการตรวจสอบแล้ว', Auth::user()));
        return back()->with('success', 'โครงงานผ่านแล้ว รอแต่งตั้งกรรมการ');
    }
    public function allreject($id)
    {
        $reg_project = project_user::where('id_reg_Std', $id)->first();
        if ($reg_project != null) {
            $reject = reject_test::join('users', 'reject_tests.id_user_reject_tests', 'users.id')
                ->select('reject_tests.*', 'users.name')
                ->where([['reject_tests.project_id_reject_tests', $reg_project->Project_id]])->withTrashed()->get();
            // collect($reject)->groupBy(['test_id']);
            // $reject->groupBy('test_id');

            if ($reject == []) {
                // $datas =0;
                foreach ($reject as $key => $box_data) {
                    $rejects[] = $box_data;
                }
                $datas = collect($rejects)->groupBy('test_id');
            } else {
                $datas = null;
            }

            return view('info_word_template.allreject', compact('datas'));
            return response()->json($datas);
        } else {
            $datas = null;
            return view('info_word_template.allreject', compact('datas'));
            return response()->json($datas);
        }
    }
    public function paginate($items, $perPage = 1, $page = null, $options = ['path' => 'http://127.0.0.1:8000/SendGrade'])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function SendGrade_page()
    {
        if (Auth::user()->hasRole('Admin')) {
            $data = reg_std::join('collect_points', 'reg_stds.id', 'collect_points.reg_id_collect_points')
                ->join('subject_students', 'reg_stds.id', 'subject_students.student_id')
                ->join('subjects', 'subject_students.subject_id', 'subjects.id')
                ->select('reg_stds.id', 'reg_stds.name', 'reg_stds.std_code', 'collect_points.grade', 'subjects.year_term', 'collect_points.project_id_collect_points')
                ->where([['collect_points.deleted_at', NULL], ['reg_stds.deleted_at', NULL]])->get()
                ->groupBy(['year_term', 'project_id_collect_points']);
            
            $myCollectionObj = collect($data);

            $datas = $this->paginate($myCollectionObj);
            // return response()->json($datas);
            return view('Admin.SendGrade', compact('datas'));
        }
    }
    public function SendGrade(Request $request)
    {
        if (Auth::user()->hasRole('Admin')) {
            $data = $request->code_id;
            $templateProcessor = new TemplateProcessor(storage_path('word-template/แบบฟอร์มบันทึกผลคะแนนเป็นรายบุคคล.docx'));

            foreach ($data as $key => $itme) {
                $datas =  CollectPoints::where('reg_id_collect_points', $itme)->first();
                $datas->SendGrade = 2;
                $datas->save();
                // $array[] = $itme;

            }

            for ($a = 0; $a < 15; $a++) {
                $array[] = $a;
                foreach ($data as $key => $itme) {
                    if ($key == $a) {
                        $arrays[] = $key;
                        $Datas_reg = reg_std::find($itme);
                        $collect_points = CollectPoints::where('reg_id_collect_points', $itme)->first();
                        $templateProcessor->setValue('id' . $key, $Datas_reg->std_code);
                        $templateProcessor->setValue('name' . $key, $Datas_reg->name);
                        $templateProcessor->setValue('grade' . $key,  $collect_points->grade);
                        $templateProcessor->setValue('note_std' . $key,  $Datas_reg->note);
                    }
                }
            }
            $g = collect($array);
            $c = $g->diffAssoc($arrays);
            foreach ($c as $key => $itme) {
                $r[] = $itme;
                $templateProcessor->setValue('id' . $key, "");
                $templateProcessor->setValue('name' . $key, "");
                $templateProcessor->setValue('grade' . $key, "");
                $templateProcessor->setValue('note_std' . $key, "");
            }

            $about_subject = subject_student::join('subjects', 'subject_students.subject_id', 'subjects.id')->select('subjects.term', 'subjects.year')
                ->where('subject_students.student_id', $Datas_reg->id)->first();

            $about_project = project_user::join('projects', 'project_users.Project_id', 'projects.id')
                ->join('project_instructors', 'projects.id', 'project_instructors.Project_id')
                ->join('teachers', 'project_instructors.id_instructor', 'teachers.id')
                ->select('teachers.*')->where([['id_reg_Std', $Datas_reg->id], ['Is_director', 0], ['Is_president', 1]])->first();

            $templateProcessor->setValue('note',  $request->note);
            $templateProcessor->setValue('term',  $about_subject->term);
            $templateProcessor->setValue('year',  $about_subject->year);
            $templateProcessor->setValue('name_president',  $about_project->Title_name_Instructor . $about_project->name_Instructor);
            $templateProcessor->setValue('date_now', formatDateThai(date("Y-m-d")));



            $fileName = storage_path("แบบฟอร์มบันทึกผลคะแนนเป็นรายบุคคล" . '.docx');
            $templateProcessor->saveAs($fileName);
            return response()->download($fileName)->deleteFileAfterSend(true);
            // return response()->json($array);
            // return response()->json([$r, $arrays, $data,$Datas_reg]);
            // return back();
        }
    }
}
