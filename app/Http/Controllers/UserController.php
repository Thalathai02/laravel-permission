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
        $data = User::orderBy('id', 'ASC')->paginate(20);
        return view('User.index', compact('data'));
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
                'password' =>'required',
                'Newpassword',
                'ConfirmPassword' => 'same:Newpassword'
        ]);
            $data = $request->all();
            $user_user = User::find(auth()->user()->id);
            if (!Hash::check($data['password'], $user_user->password)) {
                return back()->with('error', 'The specified password does not match the database password');
            } else {
                // write code to update password
                if ($data['ConfirmPassword']==null) {
                    User::find($id)->update([
                        'username' => $request->username,
                    ]);
                    return redirect(route('home'));
                } else {
                    User::find($id)->update([
                    'username' => $request->username,
                    'password' => bcrypt($request->Newpassword),
                ]);
                    return redirect(route('home'));
                }
            }
        }
        if ($user->hasRole('Admin')) {
            $request->validate([
                
                'username',
                'email',
                'password' =>'required',
                'Newpassword',
                'ConfirmPassword' => 'same:Newpassword'
        ]);
            $data = $request->all();
            $user_user = User::find(auth()->user()->id);
            if (!Hash::check($data['password'], $user_user->password)) {
                return back()->with('error', 'The specified password does not match the database password');
            } else {
                // write code to update password
                if ($data['ConfirmPassword']==null) {
                    User::find($id)->update([
                        'username' => $request->username,
                        'email' => $request->email,
                        'name'=> $request->name,
                    ]);
                    return redirect(route('home'));
                } else {
                    User::find($id)->update([
                        'username' => $request->username,
                        'email' => $request->email,
                        'name'=> $request->name,
                        'password' => bcrypt($request->Newpassword),
                ]);
                    return redirect(route('home'));
                }
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
        User::find($id)->delete();
        return redirect('/User');
    }
    public function Search(Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('Admin')) {
            $Search =$request->get(
                'Search'
            );
            $data =User::query()
        ->where('name', 'LIKE', "%{$Search}%")
        ->orWhere('username', 'LIKE', "%{$Search}%")
        ->get();
            return view('User.index', compact('data'));
        } else {
            abort(404);
        }
    }
}
