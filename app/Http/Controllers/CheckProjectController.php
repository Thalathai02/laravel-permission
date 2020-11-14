<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\reg_std;
use App\project;
use App\Teacher;
use App\subject;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Project_Instructor;
use App\project_user;
use App\subject_student;
use Illuminate\Support\Facades\Storage;
use App\Project_File;

class CheckProjectController extends Controller
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
            // $datas = DB::table('projects')
            // ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
            // ->join('project_instructor','projects.id','=', 'project_instructor.Project_id')
            // ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
            // ->join('teachers','project_instructor.ID_Instructor','=', 'teachers.id')
            // ->select('projects.*', 'project_user.*','reg_stds.*')->get();

            $datas = project::orderBy('id', 'ASC')->get();
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
        $user = $request->user();

        if ($user->hasRole('Admin')) {
            $datas1 = DB::table('projects')
                ->join('project_instructor', 'projects.id', '=', 'project_instructor.Project_id')
                ->join('teachers', 'project_instructor.ID_Instructor', '=', 'teachers.id')
                ->select('teachers.*')->where('projects.id', '=', $id)->get();
            // return response()->json([
            //     'id' => $datas1
            // ]);

            if (empty($datas1)) {
                $datas = DB::table('projects')
                    ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
                    ->join('project_instructor', 'projects.id', '=', 'project_instructor.Project_id')
                    ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                    ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
                    ->join('teachers', 'project_instructor.ID_Instructor', '=', 'teachers.id')
                    ->select('projects.*', 'project_user.*', 'reg_stds.*', 'teachers.*', 'project__files.*')->where('projects.id', '=', $id)->get();
                return view('projects.info_project', compact('datas'));
            } else {
                $datas = DB::table('projects')
                    ->join('project_user', 'projects.id', '=', 'project_user.Project_id')
                    ->join('project__files', 'projects.id', '=', 'project__files.Project_id_File')
                    ->join('reg_stds', 'project_user.id_reg_Std', '=', 'reg_stds.id')
                    ->select('projects.*', 'project_user.*', 'reg_stds.*', 'project__files.*')->where('projects.id', '=', $id)->get();
                return view('projects.info_project', compact('datas'));
            }
        } else {
            abort(404);
        }
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
        DB::table('projects')->where('id', '=', $id)->update(['status' => "reject"]);
        return redirect('/Check_Project');
    }
    public function download($file){

        return response()->download(storage_path('/app/not Check/'.$file));
     }
}
