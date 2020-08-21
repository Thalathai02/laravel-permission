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

class ImportExcelController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   function index()
   {
    $data = reg_std::orderBy('id', 'ASC')->get();
    return view('STD.index', compact('data'));
   }
/**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   function import(Request $request)
   {
       $request->validate([
           'import_file' => 'required|mimes:xls,xlsx'
       ]);
       
       Excel::import(new ImportStd, request()->file('import_file'));
       return back()->with('success', 'Contacts imported successfully.');
   }
   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
       return view('STD.Std_create');
   
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
           'IDedit',
           'type'=>'std'
           
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
   public function edit($id)
   {
       $data=User::find($id);
       $data=reg_std::find($id);
       return view('STD.edit',compact(['data']));
   }

   public function update(Request $request, $id)
   {
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
           'type'
       ]);
       User::find($id)->update($request->all());
       reg_std::find($id)->update($request->all());
       
       return redirect('/STD');
   }
   public function destroy(Request $request,$id)
   {
    if ($request->user()->can('delete-tasks')) {
        User::find($id)->delete();
        reg_std::find($id)->delete();
        return redirect('/STD');
      }
       
   }

}
