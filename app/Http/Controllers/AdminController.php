<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\Permission;
use App\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\admin;

class AdminController extends Controller
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
            $data = admin::orderBy('id', 'ASC')->get();
            return view('Admin.index', compact('data'));
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
            return view('Admin.admin_create');
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
        $std_role = Role::where('slug', 'Admin')->first();
        $std_perm = Permission::where('slug', 'create-tasks')->first();
        $User = new User();
        $admin = new admin();
        $User->name = $request['Title_name_admin'] . $request['name_admin'];
        $User->email = $request['email_admin'];
        $User->username = $request['username_admin'];
        $User->password =  Hash::make($request['password_admin']);
        $User->save();
        $User->roles()->attach($std_role);
        $User->permissions()->attach($std_perm);

        $admin->Title_name_admin = $request['Title_name_admin'];
        $admin->name_admin   = $request['name_admin'];
        $admin->phone_admin  = $request['phone_admin'];
        $admin->lineId_admin = $request['lineId_admin'];
        $admin->email_admin = $request['email_admin'];
        $admin->facebook_admin = $request['facebook_admin'];

        $admin->user_id_admin = $User->id;
        $admin->save();
        $User->save();

        return redirect('/Admin');
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
            $data = admin::find($id);
            return view('Admin.edit', compact(['data']));
        }
        if ($user->hasRole('Admin')) {
            $data = admin::find($id);
            return view('Admin.edit', compact(['data']));
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
            if ($request->hasFile('avatar')) {
                $request->validate([
                    'name_admin',
                    'phone_admin',
                    'lineId_admin',
                    'email_admin' => ['required', 'email'],
                    'facebook_admin',
                    'avatar' => 'mimes:jpeg,png|max:4096',
                ]);
                admin::find($id)->update($request->all());
                $name =  time() . '_' . $request->name_admin . '.jpg';
                // return response()->json($name);
                Storage::disk('local')->putFileAs(
                    'public/avatar',
                    request()->file('avatar'),
                    $name
                );
                $reg_Avatar = admin::find($id);
                $reg_Avatar->avatar = $name;
                $reg_Avatar->save();
            }else{
                $request->validate([
                    'name_admin',
                    'phone_admin',
                    'lineId_admin',
                    'email_admin' => ['required', 'email'],
                    'facebook_admin',
                ]);
                admin::find($id)->update($request->all());
            }
            $tec = admin::find($id);
            $user = User::find($tec->user_id_admin);
            $user->name = $request['Title_name_admin'] . $request['name_admin'];
            $user->email = $request['email_admin'];
            $user->save();
            return redirect('/home');
        }
        if ($user->hasRole('Admin')) {
            $request->validate([
                'name_admin',
                'user_id_admin',
                'Title_name_admin',
                'phone_admin',
                'lineId_admin',
                'email_admin' => ['required', 'email'],
                'facebook_admin',
            ]);
            admin::find($id)->update($request->all());
            $tec = admin::find($id);
            $user = User::find($tec->user_id_admin);
            $user->name = $request['Title_name_admin'] . $request['name_admin'];
            $user->email = $request['email_admin'];
            $user->save();
            return redirect('/Admin');
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
        admin::find($id)->delete();

        return redirect('/admin');
    }
    public function info_admin($id)
    {
        $data= admin::find($id);
        // return response()->json($data_Instructor);
        return view('Admin.admin_info', compact('data'));
    }
}
