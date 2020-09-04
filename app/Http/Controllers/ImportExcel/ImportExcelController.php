<?php

namespace App\Http\Controllers\ImportExcel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\ImportStd;
use Maatwebsite\Excel\Facades\Excel;
use App\reg_std;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Permission;
use App\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Else_;

class ImportExcelController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   function index(Request $request)
   {
    $user = $request->user();
    if ($user->hasRole('Admin')) {
        $data = reg_std::orderBy('id', 'ASC')->get();
        return view('STD.index', compact('data'));
    }else{
        abort(404);
    }
   }
/**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   function import(Request $request)
   {
       $user = $request->user();
    if ($user->hasRole('Admin')) {
        $request->validate([
           'import_file' => 'required|mimes:xls,xlsx'
       ]);
       
        Excel::import(new ImportStd, request()->file('import_file'));
        return back()->with('success', 'Contacts imported successfully.');
    }else{
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
        return view('STD.Std_create');
    }else{
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
        $request->validate([
           'std_code'=>'required',
           'name',
           'nick_name',
           'phone',
           'lineId',
           'email'=>'required|email',
           'facebook',
           'address',
           'parent_name',
           'parent_phone',
           'username',
           'password',

           
       ]);
        reg_std::create($request->all());
        $std_role = Role::where('slug','std')->first();
        $std_perm = Permission::where('slug','edit')->first();
        $student = new User();
	    $student->name = $request['name'];
        $student->email = $request['email'];
        $student->username = $request['username'];
		$student->password =  $request['password'];
        $student->save();
		$student->roles()->attach($std_role);
        $student->permissions()->attach($std_perm);
    
        
        return redirect('/STD');
    
   }
  /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit(Request $request,$id)
   { 
       $id_user = Auth::user()->reg_std_id;
        $user = $request->user();
        if ($id_user == $id) {
            $data=reg_std::find($id);
            return view('STD.edit', compact(['data']));
        }if($user->hasRole('Admin')){ 
            $data=reg_std::find($id);
            return view('STD.edit', compact(['data']));
        } else{
            abort(404);
        }
   }

   public function update(Request $request, $id)
   {
    $id_user = Auth::user()->reg_std_id;
    $user = $request->user();
    if ($id_user == $id) {
       $request->validate([
           'std_code'=>['required'],
           'name',
           'nick_name',
           'phone',
           'lineId',
           'email'=>['required','email'],
           'facebook',
           'address',
           'parent_name',
           'parent_phone',
           'username',
           'password',
       ]);
       reg_std::find($id)->update($request->all());
       return redirect('/home');
    }if($user->hasRole('Admin')){ 
        $request->validate([
            'std_code'=>['required'],
            'name',
            'nick_name',
            'phone',
            'lineId',
            'email'=>['required','email'],
            'facebook',
            'address',
            'parent_name',
            'parent_phone',
            'username',
            'password',
        ]);
        reg_std::find($id)->update($request->all());
        return redirect('/STD');
    } else{
        abort(404);
    }

   }
   public function destroy(Request $request,$id)
   { 
        reg_std::find($id)->delete();
       
        return redirect('/STD');
      
       
   }


}
