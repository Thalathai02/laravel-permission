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
      @if (Auth::user()->hasRole('Admin'))
      <a href="/projects/into_project" class="btn btn-primary my-2" align="left">เพิ่มโปรเจค</a>
      <a href="/Check_Project" class="btn btn-warning my-2" align="left">ตรวจโปรเจค</a>
      <a href="" class="btn btn-info my-2" align="left">สถานะโปรเจค</a>
      <table class="table table-striped">
         <thead>
            <tr>
               <th scope="col">ลำดับโครงงาน</th>
               <th scope="col">รหัสนักศึกษา</th>
               <th scope="col">ชื่อ-สกุล</th>
               <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
               <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>            
               <th scope="col">ที่ปรึกษาพิเศษ</th>
               <th scope="col">หมายเหตุ</th>
            </tr>
         </thead>
         <tbody>
            @foreach($datas as $row)
            @if( $row->status == "Check")
            <tr>
               <th scope="row">{{$row->Project_id}}</th>
               <td>{{$row->std_code}}</td>
               <td>{{$row->name}}</td>
               <td>{{$row->name_th}}</td>
               <td>{{$row->name_en}}</td>
               <td>{{$row->name_mentor}}</td>
               <td></td>
            </tr>
            @endif
            @endforeach
         </tbody>
      </table>
      @endif
      @if (Auth::user()->hasRole('Std'))
      @if($data_std == null)
      <a href="/projects/into_project" class="btn btn-primary my-2" align="left">เพิ่มโปรเจค</a>
      @endif
      @if($reject !== null)
      <a href="" class="btn btn-danger my-2" align="left">แก้ไขโปรเจค</a>
      
      @endif

      <table class="table table-striped">
         <thead>
            <tr>
               <th scope="col">ลำดับโครงงาน</th>
               <th scope="col">รหัสนักศึกษา</th>
               <th scope="col">ชื่อ-สกุล</th>
               <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
               <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>            
               <th scope="col">ที่ปรึกษาพิเศษ</th>
               <th scope="col">หมายเหตุ</th>
            </tr>
         </thead>
         <tbody>
            @foreach($datas as $row)
            @if( $row->status == "Check")
            <tr>
               <th scope="row">{{$row->Project_id}}</th>
               <td>{{$row->std_code}}</td>
               <td>{{$row->name}}</td>
               <td>{{$row->name_th}}</td>
               <td>{{$row->name_en}}</td>
               <td>{{$row->name_mentor}}</td>
               <td></td>
            </tr>
            @endif
            @endforeach
         </tbody>
      </table>
      @endif
   </div>
</body>

</html>

@endsection