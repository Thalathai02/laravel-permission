<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use App\Permission;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            return view('Teacher.index', compact('data'));
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
        $User = new User();
        $reg = new Teacher();
        $User->name = $request['Title_name_Instructor'] . $request['name_Instructor'];
        $User->email = $request['email_Instructor'];
        $User->username = $request['username_Instructor'];
        $User->password =  Hash::make($request['password_Instructor']);
        $User->save();
        $User->roles()->attach($std_role);
        $User->permissions()->attach($std_perm);

        $reg->Title_name_Instructor = $request['Title_name_Instructor'];
        $reg->name_Instructor   = $request['name_Instructor'];
        $reg->phone_Instructor  = $request['phone_Instructor'];
        $reg->lineId_Instructor  = $request['lineId_Instructor'];
        $reg->email_Instructor  = $request['email_Instructor'];
        $reg->facebook_Instructor  = $request['facebook_Instructor'];

        $reg->user_id_Instructor  = $User->id;
        $reg->save();
        $User->reg_tea_id  =  $reg->id;
        $User->save();

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
            $data = Teacher::find($id);
            return view('Teacher.edit', compact(['data']));
        }
        if ($user->hasRole('Admin')) {
            $data = Teacher::find($id);
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
            if ($request->hasFile('avatar')) {
                $request->validate([
                    'Title_name_Instructor',
                    'name_Instructor',
                    'phone_Instructor',
                    'lineId_Instructor',
                    'email_Instructor' => ['required', 'email'],
                    'facebook_Instructor',
                    'avatar' => 'mimes:jpeg,png|max:4096',
                ]);
                Teacher::find($id)->update($request->all());
                $name =  time() . '_' . $request->name_Instructor . '.jpg';
                // return response()->json($name);
                Storage::disk('local')->putFileAs(
                    'public/avatar',
                    request()->file('avatar'),
                    $name
                );
                $reg_Avatar = Teacher::find($id);
                $reg_Avatar->avatar = $name;
                $reg_Avatar->save();
            }else{
                $request->validate([
                    'Title_name_Instructor',
                    'name_Instructor',
                    'phone_Instructor',
                    'lineId_Instructor',
                    'email_Instructor' => ['required', 'email'],
                    'facebook_Instructor',
                ]);
                Teacher::find($id)->update($request->all());
            }
            $tec = Teacher::find($id);
            $user = User::find($tec->user_id_Instructor);
            // return response()->json($tec->user_id_Instructor);
            $user->name = $request['Title_name_Instructor'] . $request['name_Instructor'];
            $user->email = $request['email_Instructor'];
            $user->save();
            return redirect('/home');
        }
        if ($user->hasRole('Admin')) {
            $request->validate([
                'name_Instructor',
                'user_id_Instructor',
                'Title_name_Instructor',
                'phone_Instructor',
                'lineId_Instructor',
                'email_Instructor' => ['required', 'email'],
                'facebook_Instructor',
            ]);
            Teacher::find($id)->update($request->all());
            $tec = Teacher::find($id);
            $user = User::find($tec->user_id_Instructor);
            $user->name = $request['Title_name_Instructor'] . $request['name_Instructor'];
            $user->email = $request['email_Instructor'];
            $user->save();
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
            $Search = $request->get(
                'Search'
            );
            $data = Teacher::query()
                ->where('name_Instructor', 'LIKE', "%{$Search}%")
                ->orWhere('id', 'LIKE', "%{$Search}%")
                ->get();
            return view('Teacher.index', compact('data'));
        } else {
            abort(404);
        }
    }
    public function info_tea($id)
    {
        $data_Instructor = Teacher::find($id);
        // return response()->json($data_Instructor);
        return view('Teacher.tea_info', compact('data_Instructor'));
    }
}
