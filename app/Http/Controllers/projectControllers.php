<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\reg_std;
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
            $data = $request['Project_name_thai'];
            $data2 = $request['Project_name_eg'];
            $request->session()->flash('name_th', $data);
            $request->session()->flash('name_eg', $data2);
            return view('/projects/list_name');

        } else {
            abort(404);
        }
    }
    public function Searchreg1(Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('Admin')) {
            $Search = $request->get(
                'reg_std1'
            );
            $data= reg_std::query()
                ->where('std_code', 'LIKE', "%{$Search}%")
                ->get();
            return view('projects.list_name', compact('data'));
        } else {
            abort(404);
        }
    }
}
