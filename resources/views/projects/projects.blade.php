@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>

<body>
   <br />

   <div class="container">
      <h3 align="center">Projects</h3>
      <br />
      @if(count($errors) > 0)
      <div class="alert alert-danger">
         <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif
      <a href="/projects/into_project" class="btn btn-primary my-2" align="left">เพิ่มโปรเจค</a>
      <table class="table table-striped">
         <thead>
            <tr>
               <th scope="col">ลำดับโครงงาน</th>
               <th scope="col">รหัสนักศึกษา</th>
               <th scope="col">ชื่อ-สกุล</th>
               <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
               <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>
               <th scope="col">ประธาน</th>
               <th scope="col">กรรมการ</th>
               <th scope="col">ที่ปรึกษาพิเศษ</th>
               <th scope="col">หมายเหตุ</th>
               <th>แก้ไข</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <th scope="row"></th>
               <td>
                  <hr>
                  <hr>
               </td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td> <a href="" class="btn btn-success my-2" align="left">แก้ไข</a></td>
            </tr>
         </tbody>
      </table>
   </div>
</body>

</html>

@endsection