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
      <a href="" class="btn btn-warning my-2" align="left">ตรวจโปรเจค</a>
      <a href="" class="btn btn-info my-2" align="left">สถานะโปรเจค</a>

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

            </tr>
         </thead>


         <tbody>
            @foreach($datas as $row)
            <tr>
               <th scope="row">{{$row->Project_id}}</th>
               <td>{{$row->std_code}}</td>
               <td>{{$row->name}}</td>
               <td>{{$row->name_th}}</td>
               <td>{{$row->name_en}}</td>
               <td>{{$row->name_Instructor}}</td>
               <td></td>
               <td>{{$row->name_mentor}}</td>
               <td></td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</body>

</html>

@endsection