<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
    public function edit(Request $request, $id)
    {
        $id_user = Auth::user()->id;
        $user = $request->user();
        if ($id_user == $id) {
            $data=User::find($id);
            return view('User.edit', compact(['data']));
        }
        if ($user->hasRole('Admin')) {
            $data=User::find($id);
            return view('User.edit', compact(['data']));
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
       
        $id_user = Auth::user()->id;
        $user = $request->user();
       
        if ($id_user == $id) {
            $request->validate([
                
                'username',
                'password' => 'min:6',
                'ConfirmPassword' => 'same:password|min:6'
        ]);
            $data = $request->all();
            if ($data['ConfirmPassword'] == $request->password) {
                User::find($id)->update([
                    'username'=>$request->username,
                    'password' => bcrypt($request->password),
                ]);
                return redirect('/home');
            } else {
                return back()->with('error', 'The specified password does not match the database password');
            }
        }
        if ($user->hasRole('Admin')) {
            $request->validate([
                'name' => 'required|min:3',
                'email' => 'email',
                'username',
                'password' => 'min:6',
                'ConfirmPassword' => 'same:password|min:6'
        ]);
            $data = $request->all();
            if ($data['ConfirmPassword'] == $request->password) {
                User::find($id)->update([
                    'username'=>$request->username,
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);
                return redirect('/home');
            } else {
                return back()->with('error', 'The specified password does not match the database password');
            }
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
}
