<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\subject;
use App\system;
class systemController extends Controller
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
            $term = subject::pluck('year_term', 'id');
            return view('system.pageinto' ,compact('term'));
         
        } else {
            abort(404);
        }
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
    public function show(Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('Admin')) {
            $data_subject = $request->get(
                'subject'
            );
            $data = subject::query()->where('id', 'LIKE', "%{$data_subject}%")->get();
            return view('system.index',compact('data'));
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
        $user = $request->user();
        
        if ($user->hasRole('Admin')) {
            // $data2 = subject::query()->where('datePropose', 'LIKE', "%{$id}%")->get();
            // $request->validate([
            //    'DatePropose',
            //    'OutPropose',
            //    'Datedecide',
            //    'Outdecide',
            //    'Datedecide',
            //    'Outdecide',
            //    'Datesend',
            //    'Outdecide',
            //    'DateComment',
            //    'OutComment',
            //    'DateSubmitProject',
            //    'OutSubmitProject',
            //    'DateDue50',
            //    'OutDue50',
            //    'DateDue100',
            //    'OutDue100'
            // ]);
            // subject::find($id)->update($request->all());
            return redirect('/system');
        }else {
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
}
