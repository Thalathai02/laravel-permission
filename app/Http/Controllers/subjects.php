<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\subject;
use App\reg_std;
use App\subject_student;
use App\system;

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

        $check_data = subject::where('year_term',$request['year'].'/'.$request['term'])->first();
        if(isset($check_data)){
            return  back()->withErrors('ปีการศึกษาซ้ำ กรุณาตรวจสอบ');
        }else{
            $request->validate([
                'test50' => ['required'],
                'test100' => ['required'],
                'presentations'=> 'required',
                'Test_in_time' => 'required',
                'Internship_score'=> 'required',
               
            ]);
            $student = new reg_std();
            $reg = new subject();
            $subject = new subject_student();
            $system = new system ;
    
            $reg->name_subjects   = 'CS498';
            $reg->year  = $request['year'];
            $reg->term  = $request['term'];
            $reg->year_term  = $request['year'].'/'.$request['term'];
         
            $reg->test50 = $request['test50'];
            $reg->test100 = $request['test100'];
            $reg->presentations = $request['presentations'];
            $reg->Test_in_time = $request['Test_in_time'];
            $reg->Internship_score = $request['Internship_score'];
    
            // $reg->DatePropose =  \Carbon\Carbon::now()->format('d-m-Y');
            // $reg->OutPropose =  \Carbon\Carbon::tomorrow()->format('d-m-Y') ;
            // $reg->Datedecide =  \Carbon\Carbon::now()->format('d-m-Y') ;
            // $reg->Outdecide =  \Carbon\Carbon::tomorrow()->format('d-m-Y') ;
            // $reg->DateComment =  \Carbon\Carbon::now()->format('d-m-Y') ;
            // $reg->OutComment =  \Carbon\Carbon::tomorrow()->format('d-m-Y') ;
            // $reg->DateSubmitProject =  \Carbon\Carbon::now()->format('d-m-Y') ;
            // $reg->OutSubmitProject =  \Carbon\Carbon::tomorrow()->format('d-m-Y') ;
            // $reg->DateDue50 =  \Carbon\Carbon::now()->format('d-m-Y') ;
            // $reg->OutDue50 =  \Carbon\Carbon::tomorrow()->format('d-m-Y') ;
            // $reg->DateDue100 =  \Carbon\Carbon::now()->format('d-m-Y') ;
            // $reg->OutDue100 =  \Carbon\Carbon::tomorrow()->format('d-m-Y') ;
            // $reg->DateComment50 =  \Carbon\Carbon::now()->format('d-m-Y') ;
            // $reg->OutComment50 =  \Carbon\Carbon::tomorrow()->format('d-m-Y') ;
            // $reg->DateComment100 =  \Carbon\Carbon::now()->format('d-m-Y') ;
            // $reg->OutComment100 =  \Carbon\Carbon::tomorrow()->format('d-m-Y') ;
    
           
            $reg->save();
            return redirect('/STD');
        }
        
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
