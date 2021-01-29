<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;

use App\reg_std;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Permission;
use App\Role;
use App\subject_student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


class ImportStd implements ToModel
{
    use RegistersUsers;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $std_role = Role::where('slug', 'std')->first();
        $std_perm = Permission::where('slug', 'edit')->first();
        $reg = new reg_std();
        $subject = new subject_student();


        // $student = new User();
        // $student = User::all();
        // $student->roles()->attach($std_role);
        // $student->permissions()->attach($std_perm);
        if (empty($row[0])) {
            // errors()->add('field', 'Something is wrong with this field!');
        }
        if (empty($row[1])) {
            // errors()->add('field', 'Something is wrong with this field!');
        } else {
            $student = new User();
            $student->name = $row[2];
            $student->email = $row[6];
            $student->username = 'MJU' . $row[1];
            $student->password =  bcrypt($row[1]);
            $student->save();
            $student->roles()->attach($std_role);
            $student->permissions()->attach($std_perm);


            $reg->std_code = $row[1];
            $reg->name   = $row[2];
            $reg->nick_name  = $row[3];
            $reg->phone  = $row[4];
            $reg->lineId  = $row[5];
            $reg->email  = $row[6];
            $reg->facebook  = $row[7];
            $reg->address  = $row[8];
            $reg->parent_name  = $row[9];
            $reg->parent_phone = $row[10];
            $reg->username  = 'MJU' . $row[1];
            $reg->password  = Hash::make($row[1]);
            $reg->user_id  = $student->id;
            $reg->save();
            $student->reg_std_id  =  $reg->id;
            $student->save();
            $subject->student_id = $reg->id;
            $subject->subject_id = Session::get('subject_id');
            $subject->save();
        }





        // $reg->user()->attach($std_reg);

        // return new reg_std([
        //     'std_code'   => $row[1],
        //     'name'   => $row[2],
        //     'nick_name'    => $row[3],
        //     'phone'  => $row[4],
        //     'lineId'   => $row[5],
        //     'email'  => $row[6],
        //     'facebook'  => $row[7],
        //     'address'  => $row[8],
        //     'parent_name'  => $row[9],
        //     'parent_phone'  => $row[10],
        //     'username'  => 'MJU'. $row[1],
        //     'password'  => Hash::make($row[1]),

        // ]);
    }
}
