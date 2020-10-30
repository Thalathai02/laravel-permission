<?php

namespace App\Http\Controllers;

use App\project;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\reg_std;
use App\Teacher;
class projectControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('projects.projects');
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
           
            return view('projects.into_project');

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
        $request->validate([
            'data_nameProject'
        ]);
        $data_project = "Test";
        $user = $request->user();
        if ($user->hasRole('Admin')) {
            $Search = $request->get('reg_std1');
            $data= reg_std::query()->where('std_code', 'LIKE', "{$Search}")->get();
            if(!empty($request->get('reg_std2'))){
                $Search2 = $request->get('reg_std2');
            $data2= reg_std::query()->where('std_code', 'LIKE', "{$Search2}")->get();
            }else{
                $data2 = null;
            }if(!empty($request->get('reg_std3'))){
                $Search3 = $request->get('reg_std3');
                $data3= reg_std::query()->where('std_code', 'LIKE', "{$Search3}")->get();
            }else{
                $data3=null;

            }if(!empty($request->get('name_president'))){
                $Search_name_president = $request->get('name_president');
                $name_president= Teacher::query()->where('name', 'LIKE', "%{$Search_name_president}%")->get();
            }else{
                $name_president=null;
            }if(!empty($request->get('name_director1'))){
                $Search_name_director1 = $request->get('name_director1');
                $name_director1= Teacher::query()->where('name', 'LIKE', "%{$Search_name_director1}%")->get();
            }else{
                $name_director1=null;
            }if(!empty($request->get('name_director2'))){
                $Search_name_director2 = $request->get('name_director2');
                $name_director2= Teacher::query()->where('name', 'LIKE', "%{$Search_name_director2}%")->get();
            }else{
                $name_director2=null;
            }
            return response()->json([
                'reg_std1' => $data,
                'reg_std2' => $data2,
                'reg_std3'=> $data3,
                'tec' => $name_president,
            ]);
            // return view('/projects/submit_project', compact("data","data2","data3","name_president","name_director1","name_director2"));
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
    public function listname(Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('Admin')) {
           
            return view('projects.list_name');

        } else {
            abort(404);
        }
    }
    public function createNameProject(Request $request){
        $user = $request->user();
        $request->validate([
            'Project_name_thai'=>'required',
            'Project_name_eg'=>'required'
        ]);
        if ($user->hasRole('Admin')) {
            $name = new project();
            $name->name_th = $request['Project_name_thai'];
            $name->name_en = $request['Project_name_eg'];
            $name->save();
            $id =  $name->id;
            $data_nameProject = project::find($id);
            return view('/projects/list_name',compact("data_nameProject"));

        } else {
            abort(404);
        }
    }
}
