<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use App\Permission;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class TeacherController extends Controller
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
            $data = Teacher::orderBy('id', 'ASC')->get();
            return view('Teacher.index',compact('data'));
        } else {
            abort(404);
        }
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
            return view('Teacher.tea_create');
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
        $std_role = Role::where('slug', 'Tea')->first();
        $std_perm = Permission::where('slug', 'edit')->first();
        $student = new User();
        $reg = new Teacher();
        $student->name = $request['name'];
        $student->email = $request['email'];
        $student->username = $request['username'];
        $student->password =  Hash::make($request['password']);
        $student->save();
        $student->roles()->attach($std_role);
        $student->permissions()->attach($std_perm);
    

        $reg->name   = $request['name'];
        $reg->phone  = $request['phone'];
        $reg->lineId  = $request['lineId'];
        $reg->email  = $request['email'];
        $reg->facebook  = $request['facebook'];

        $reg->user_id  = $student->id;
        $reg->save();
        $student->reg_tea_id  =  $reg->id;
        $student->save();
        
        return redirect('/Teacher');
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
        $id_user = Auth::user()->reg_tea_id;
        $user = $request->user();
        if ($id_user == $id) {
            $data=Teacher::find($id);
            return view('Teacher.edit', compact(['data']));
        }
        if ($user->hasRole('Admin')) {
            $data=Teacher::find($id);
            return view('Teacher.edit', compact(['data']));
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
        $id_user = Auth::user()->reg_tea_id;
        $user = $request->user();
        if ($id_user == $id) {
            $request->validate([
           'name',
           'phone',
           'lineId',
           'email'=>['required','email'],
           'facebook',
       ]);
       Teacher::find($id)->update($request->all());
            return redirect('/home');
        }
        if ($user->hasRole('Admin')) {
            $request->validate([
                'name',
                'phone',
                'lineId',
                'email'=>['required','email'],
                'facebook',
        ]);
        Teacher::find($id)->update($request->all());
            return redirect('/Teacher');
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
    public function destroy(Request $request, $id)
    {
        Teacher::find($id)->delete();
       
        return redirect('/Teacher');
    }
    public function Search(Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('Admin')) {
            $Search =$request->get(
                'Search'
            );
            $data =Teacher::query()
        ->where('name', 'LIKE', "%{$Search}%")
        ->orWhere('id', 'LIKE', "%{$Search}%")
        ->get();
            return view('Teacher.index', compact('data'));
        } else {
            abort(404);
        }
    }
}
