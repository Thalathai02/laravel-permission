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

         $std_role = Role::where('slug','std')->first();
         $std_perm = Permission::where('slug','edit')->first();
        // $student = new User();
        // $student = User::all();
        // $student->roles()->attach($std_role);
        // $student->permissions()->attach($std_perm);
        $student = new User();
		$student->name = $row[2];
        $student->email = $row[6];
        $student->username = 'MJU'. $row[1];
		$student->password =  bcrypt($row[1]);
		$student->save();
		$student->roles()->attach($std_role);
		$student->permissions()->attach($std_perm);
        

        $reg = new reg_std();
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
        $reg->username  = 'MJU'. $row[1];
        $reg->password  = Hash::make($row[1]);
        $reg->save();

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
