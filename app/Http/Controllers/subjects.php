<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\subject;
use App\reg_std;
use App\subject_student;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class subjects extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
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
            return view('STD.term');
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
      
        $student = new reg_std();
        $reg = new subject();
        $subject = new subject_student();

        $reg->name   = 'CS498';
        $reg->year  = $request['year'];
        $reg->term  = $request['term'];
        $reg->year_term  = $request['year'].'/'.$request['term'];
        $reg->save();
        return redirect('/STD');
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
}
