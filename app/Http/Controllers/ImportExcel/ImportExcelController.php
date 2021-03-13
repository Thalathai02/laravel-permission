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
use App\subject;
use App\subject_student;
use Illuminate\Support\Facades\Session;



class ImportExcelController extends Controller
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
            $data = reg_std::orderBy('id', 'ASC')->get();
            $term = subject::orderBy('id','desc')->pluck('year_term', 'id');
            $data_subject = subject_student::orderBy('id', 'ASC')->get();
            $subject = subject::find($data_subject);
            $data =  reg_std::join('subject_students', 'reg_stds.id', '=', 'subject_students.student_id')
            ->join('subjects', 'subject_students.subject_id', '=', 'subjects.id')
            ->select('reg_stds.*','subjects.year_term')->paginate(20);

            // $subject =  DB::table('reg_stds')->rightJoin('subject_students', 'reg_stds.id', '=', 'subject_students.id')->get();
            // $subject =  DB::table('reg_stds')->rightJoin('subjects', 'reg_stds.id', '=', 'subjects.id')->get();
            
            return view('STD.index', compact('data', 'term', 'data_subject','subject'));
        } else {
            abort(404);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('Admin')) {
            $request->validate([
                'import_file' => 'required|mimes:xls,xlsx',
                'subject'
            ]);
            $data = $request['subject'];
            $request->session()->flash('subject_id', $data);
            Excel::import(new ImportStd, request()->file('import_file'));
            // $request->session()->fluslh();
            return back()->with('success', 'Contacts imported successfully.');
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
            $term = subject::pluck('year_term', 'id');
            return view('STD.Std_create', compact('term'));
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
        $request->validate([
            'std_code' => ['required'],
            'name'=> ['required'],
            'nick_name',
            'phone'=>'required',
            'lineId',
            'email' => ['required', 'email'],
            'facebook',
            'address' => ['required'],
            'parent_name' => ['required'],
            'parent_phone' => ['required'],
            'username' => ['required'],
            'password' => ['required'],
            'note'
        ]);
        $subject = new subject_student();
        $std_role = Role::where('slug', 'std')->first();
        $std_perm = Permission::where('slug', 'edit')->first();
        $student = new User();
        $reg = new reg_std();
        $student->name = $request['name'];
        $student->email = $request['email'];
        $student->username = $request['username'];
        $student->password =  Hash::make($request['password']);
        $student->save();
        $student->roles()->attach($std_role);
        $student->permissions()->attach($std_perm);

        $reg->std_code = $request['std_code'];
        $reg->name   = $request['name'];
        $reg->nick_name  = $request['nick_name'];
        $reg->phone  = $request['phone'];
        $reg->lineId  = $request['lineId'];
        $reg->email  = $request['email'];
        $reg->facebook  = $request['facebook'];
        $reg->address  = $request['address'];
        $reg->parent_name  = $request['parent_name'];
        $reg->parent_phone = $request['parent_phone'];
        $reg->username  = 'MJU' . $request['username'];
        $reg->password  = Hash::make($request['password']);
        $reg->user_id  = $student->id;
        $reg->note = $request['note'];
        $reg->save();
        $student->reg_std_id  =  $reg->id;
        $subject->student_id = $reg->id;
        $subject->subject_id = $request['subject_id'];
        $subject->save();

        $student->save();

        return redirect('/STD');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $id_user = Auth::user()->reg_std_id;
        $user = $request->user();
        if ($id_user == $id) {
            $data = reg_std::find($id);
            $subject_id = subject_student::where('student_id',$id)->first();
            $subject = subject::find($subject_id->subject_id);
            $term = subject::pluck('year_term', 'id');
            return view('STD.edit', compact(['data','subject']));
        }
        if ($user->hasRole('Admin')) {
            $term = subject::pluck('year_term', 'id');
            $data = reg_std::find($id);
            $subject_id = subject_student::where('student_id',$id)->first();
            $subject = subject::find($subject_id->subject_id);
            return view('STD.edit', compact(['data','subject','term']));
        } else {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        $id_user = Auth::user()->reg_std_id;
        $user = $request->user();
        if ($id_user == $id) {
            $request->validate([
                'std_code' => ['required'],
                'name',
                'nick_name',
                'phone'=>'required',
                'lineId',
                'email' => ['required', 'email'],
                'facebook',
                'address' => ['required'],
                'parent_name' => ['required'],
                'parent_phone' => ['required'],
                'username',
                'password',
                
            ]);
            reg_std::find($id)->update($request->all());
            return redirect('/home');
        }
        if ($user->hasRole('Admin')) {
            $request->validate([
                'std_code' => ['required'],
                'name' => ['required'],
                'nick_name' => ['required'],
                'subject_id'=> ['required'],
                'phone'=>'required',
                'lineId',
                'email' => ['required', 'email'],
                'facebook',
                'address' => ['required'],
                'parent_name' => ['required'],
                'parent_phone' => ['required'],
                'username',
                'password',
                'note'
            ]);
            reg_std::find($id)->update($request->all());
            $id_user=reg_std::find($id);
            $user = User::find($id_user->user_id);
            
            $user->name = $request['name'];
            $user->email=$request['email']; 
            $user->save();
            $subject = subject_student::where('student_id',$id)->first();
            $subject->subject_id = $request['subject_id'];
            // return response()->json($subject);
            $subject->save();
            return redirect('/STD');
        } else {
            abort(404);
        }
    }
    public function destroy(Request $request, $id)
    {
        reg_std::find($id)->delete();

        return redirect('/STD');
    }
    public function Search(Request $request)
    {
        $user = $request->user();
       
        if ($user->hasRole('Admin')) {
            $Search = $request->get(
                'Search'
            );
            $term = subject::pluck('year_term', 'id');
            $data = reg_std::query()
                ->where('name', 'LIKE', "%{$Search}%")
                ->orWhere('std_code', 'LIKE', "%{$Search}%")
                ->paginate(20);
            return view('STD.index', compact('data', 'term'));
        } else {
            abort(404);
        }
    }
}
