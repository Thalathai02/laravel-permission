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
use App\notification;
use App\comment_test50;



class DataTableController extends Controller
{
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
    public function data_project($Project_id)
    {

        $datas_std = DB::table('projects')
            ->join('project_users', 'projects.id', '=', 'project_users.Project_id')
            ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
            ->join('reg_stds', 'project_users.id_reg_Std', '=', 'reg_stds.id')
            ->join('subjects', 'projects.subject_id', '=', 'subjects.id')
            ->select('projects.*', 'project_users.*', 'reg_stds.*', 'project__files.*', 'subjects.*')->where([['projects.id', '=', $Project_id], ['project__files.status_file_path', '=', 'Waiting']])->get();
        return $datas_std;
    }
    public function count_data_progress($num_data)
    {
        $count = 7;
        if ($num_data == 0) {
            return '0';
        } elseif ($num_data ==  $count) {
            return '100';
        } else {
            return round((100 / $count) * $num_data);
        }
    }
    public function noti_data_allow_test50($Project_id, $id_1, $id_2, $id_3)
    {
        $notif_admin = User::find(1);
        $id_test50 = test50::where('Project_id_test50', $Project_id)->get();
        foreach ($notif_admin->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_test50[0]->id && $notificationes->data['form'] == 1) {
                $a = 0;
            }
        }
        $id_1 = Teacher::find($id_1);
        $notif_chari = User::find($id_1->user_id_Instructor);
        foreach ($notif_chari->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_test50[0]->id && $notificationes->data['form'] == 1) {
                $b = 0;
            }
        }
        $id_2 = Teacher::find($id_2);
        $notif_chari = User::find($id_2->user_id_Instructor);
        foreach ($notif_chari->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_test50[0]->id && $notificationes->data['form'] == 1) {
                $c = 0;
            }
        }
        $id_3 = Teacher::find($id_3);
        $notif_chari = User::find($id_3->user_id_Instructor);
        foreach ($notif_chari->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_test50[0]->id && $notificationes->data['form'] == 1) {
                $d = 0;
            }
        }
        if (!isset($a)) {
            $a = 1;
        }
        if (!isset($b)) {
            $b = 1;
        }
        if (!isset($c)) {
            $c = 1;
        }
        if (!isset($d)) {
            $d = 1;
        }
        if ( $a == 1 && $b == 1 && $c==1 && $d==1) {
           $submit=1;
        }else{
            $submit=0;
        }
        return  $submit;
        // return  $id_test50[0]->id;
    }
    public function noti_data_allow_report_test50s($Project_id, $id_1, $id_2, $id_3)
    {
        $notif_admin = User::find(1);
        $id_Project_id_report_test50 = ProgressReport_test50::where('Project_id_report_test50', $Project_id)->get();
        foreach ($notif_admin->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_Project_id_report_test50[0]->id && $notificationes->data['form'] == 2) {
                $a = 0;
            }
        }
        $id_1 = Teacher::find($id_1);
        $notif_chari = User::find($id_1->user_id_Instructor);
        foreach ($notif_chari->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_Project_id_report_test50[0]->id && $notificationes->data['form'] == 2) {
                $b = 0;
            }
        }
        $id_2 = Teacher::find($id_2);
        $notif_chari = User::find($id_2->user_id_Instructor);
        foreach ($notif_chari->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_Project_id_report_test50[0]->id && $notificationes->data['form'] == 2) {
                $c = 0;
            }
        }
        $id_3 = Teacher::find($id_3);
        $notif_chari = User::find($id_3->user_id_Instructor);
        foreach ($notif_chari->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_Project_id_report_test50[0]->id && $notificationes->data['form'] == 2) {
                $d = 0;
            }
        }
        if (!isset($a)) {
            $a = 1;
        }
        if (!isset($b)) {
            $b = 1;
        }
        if (!isset($c)) {
            $c = 1;
        }
        if (!isset($d)) {
            $d = 1;
        }
        if ( $a == 1 && $b == 1 && $c==1 && $d==1) {
           $submit=2;
        }else{
            $submit=0;
        }
        return  $submit;
        // return  $id_test50[0]->id;
    }
    public function noti_data_allow_test100s($Project_id, $id_1, $id_2, $id_3)
    {
        $notif_admin = User::find(1);
        $id_Project_id_test100 = test100::where('Project_id_test100', $Project_id)->get();
        foreach ($notif_admin->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_Project_id_test100[0]->id && $notificationes->data['form'] == 3) {
                $a = 0;
            }
        }
        $id_1 = Teacher::find($id_1);
        $notif_chari = User::find($id_1->user_id_Instructor);
        foreach ($notif_chari->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_Project_id_test100[0]->id && $notificationes->data['form'] == 3) {
                $b = 0;
            }
        }
        $id_2 = Teacher::find($id_2);
        $notif_chari = User::find($id_2->user_id_Instructor);
        foreach ($notif_chari->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_Project_id_test100[0]->id && $notificationes->data['form'] == 3) {
                $c = 0;
            }
        }
        $id_3 = Teacher::find($id_3);
        $notif_chari = User::find($id_3->user_id_Instructor);
        foreach ($notif_chari->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_Project_id_test100[0]->id && $notificationes->data['form'] == 3) {
                $d = 0;
            }
        }
        if (!isset($a)) {
            $a = 1;
        }
        if (!isset($b)) {
            $b = 1;
        }
        if (!isset($c)) {
            $c = 1;
        }
        if (!isset($d)) {
            $d = 1;
        }
        if ( $a == 1 && $b == 1 && $c==1 && $d==1) {
           $submit=1;
        }else{
            $submit=0;
        }
        return  $submit;
        // return  $id_test50[0]->id;
    }
    public function noti_data_allow_report_test100s($Project_id, $id_1, $id_2, $id_3)
    {
        $notif_admin = User::find(1);
        $id_Project_id_report_test100 = ProgressReport_test100::where('Project_id_report_test100', $Project_id)->get();
        foreach ($notif_admin->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_Project_id_report_test100[0]->id && $notificationes->data['form'] == 4) {
                $a = 0;
            }
        }
        $id_1 = Teacher::find($id_1);
        $notif_chari = User::find($id_1->user_id_Instructor);
        foreach ($notif_chari->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_Project_id_report_test100[0]->id && $notificationes->data['form'] == 4) {
                $b = 0;
            }
        }
        $id_2 = Teacher::find($id_2);
        $notif_chari = User::find($id_2->user_id_Instructor);
        foreach ($notif_chari->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_Project_id_report_test100[0]->id && $notificationes->data['form'] == 4) {
                $c = 0;
            }
        }
        $id_3 = Teacher::find($id_3);
        $notif_chari = User::find($id_3->user_id_Instructor);
        foreach ($notif_chari->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_Project_id_report_test100[0]->id && $notificationes->data['form'] == 4) {
                $d = 0;
            }
        }
        if (!isset($a)) {
            $a = 1;
        }
        if (!isset($b)) {
            $b = 1;
        }
        if (!isset($c)) {
            $c = 1;
        }
        if (!isset($d)) {
            $d = 1;
        }
        if ( $a == 1 && $b == 1 && $c==1 && $d==1) {
           $submit = 2;
        }else{
            $submit = 0;
        }
        return  $submit;
        // return  $id_test50[0]->id;
    }
    public function noti_data_allow_complete_forms($Project_id, $id_1, $id_2, $id_3)
    {
        $notif_admin = User::find(1);
        $id_Project_id_CompleteForm = CompleteForm::where('Project_id_CompleteForm', $Project_id)->get();
        foreach ($notif_admin->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_Project_id_CompleteForm[0]->id && $notificationes->data['form'] == 5) {
                $a = 0;
            }
        }
        $id_1 = Teacher::find($id_1);
        $notif_chari = User::find($id_1->user_id_Instructor);
        foreach ($notif_chari->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_Project_id_CompleteForm[0]->id && $notificationes->data['form'] == 5) {
                $b = 0;
            }
        }
        $id_2 = Teacher::find($id_2);
        $notif_chari = User::find($id_2->user_id_Instructor);
        foreach ($notif_chari->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_Project_id_CompleteForm[0]->id && $notificationes->data['form'] == 5) {
                $c = 0;
            }
        }
        $id_3 = Teacher::find($id_3);
        $notif_chari = User::find($id_3->user_id_Instructor);
        foreach ($notif_chari->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_Project_id_CompleteForm[0]->id && $notificationes->data['form'] == 5) {
                $d = 0;
            }
        }
        if (!isset($a)) {
            $a = 1;
        }
        if (!isset($b)) {
            $b = 1;
        }
        if (!isset($c)) {
            $c = 1;
        }
        if (!isset($d)) {
            $d = 1;
        }
        if ( $a == 1 && $b == 1 && $c==1 && $d==1) {
           $submit=2;
        }else{
            $submit=0;
        }
        return  $submit;
        // return  $id_test50[0]->id;
    }
    public function data_allow_comment_test50_Datas($Project_id, $id_1, $id_2, $id_3)
    {
        $notif_admin = User::find(1);
        $id_Project_id_CompleteForm = CompleteForm::where('Project_id_CompleteForm', $Project_id)->get();
        $comment_test50 = comment_test50::where([['project_id_comemt_test50', $Project_id], ['id_instructor_comemt_test50', $id_1]])->first();
        foreach ($notif_admin->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_Project_id_CompleteForm[0]->id && $notificationes->data['form'] == 5) {
                $a = 0;
            }
        }
        $id_1 = Teacher::find($id_1);
        $notif_chari = User::find($id_1->user_id_Instructor);
        foreach ($notif_chari->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_Project_id_CompleteForm[0]->id && $notificationes->data['form'] == 5) {
                $b = 0;
            }
        }
        $id_2 = Teacher::find($id_2);
        $notif_chari = User::find($id_2->user_id_Instructor);
        foreach ($notif_chari->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_Project_id_CompleteForm[0]->id && $notificationes->data['form'] == 5) {
                $c = 0;
            }
        }
        $id_3 = Teacher::find($id_3);
        $notif_chari = User::find($id_3->user_id_Instructor);
        foreach ($notif_chari->unreadNotifications   as $key => $notificationes) {
            if ($notificationes->data['form_id'] == $id_Project_id_CompleteForm[0]->id && $notificationes->data['form'] == 5) {
                $d = 0;
            }
        }
        if (!isset($a)) {
            $a = 1;
        }
        if (!isset($b)) {
            $b = 1;
        }
        if (!isset($c)) {
            $c = 1;
        }
        if (!isset($d)) {
            $d = 1;
        }
        if ( $a == 1 && $b == 1 && $c==1 && $d==1) {
           $submit=2;
        }else{
            $submit=0;
        }
        return  $submit;
        // return  $id_test50[0]->id;
    }
}
