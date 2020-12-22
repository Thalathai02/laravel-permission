@extends('layouts.app')
@section('content')

<!DOCTYPE html>
<html>
 <body>
  <br />
  
  <div class="container">
   <h3 align="center">Import Student information in Laravel</h3>
    <br />
   @if(count($errors) > 0)
    <div class="alert alert-danger">
     Upload Validation Error<br><br>
     <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
     </ul>
    </div>
   @endif

   @if($message = Session::get('success'))
   <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
   </div>
   @endif
  
   {!! Form::open(['action' => 'ImportExcel\ImportExcelController@Search','method'=>'POST']) !!}
   <div class="form-group col">
    {!! Form::label('Search','ค้นหา',["class"=>"form-group"])!!}
    {!! Form::text('Search',null,["class"=>"form-group col-6"]) !!}
    <input type="submit" value="ค้นหา" class="btn btn-primary  " name="submit_1" id="">
    </div>
    {!! Form::close() !!}
   
   {!! Form::open(['action' => 'ImportExcel\ImportExcelController@import','method'=>'POST','enctype'=>"multipart/form-data"]) !!}
   {{ csrf_field() }}
   <div class="form-group2">
     <h1>
      {{ Session::get('subject_id') }}
     </h1>

    {!! Form::Label('subject_id','ปีการศึกษา:') !!}
    {!! Form::select('subject', $term,['class' => 'form-control'] ) !!}
    <a href="/STD/term/create" class="btn btn-primary my-2" align="left">เพิ่มปีการศึกษา</a>
    <div class="col-md-6" align="center">
        {!! Form::file($name ?? 'import_file', $attributes = [])!!}
        <input type="submit" value="อัพโหลด" class="btn btn-primary col-2 " name="submit_2" id="">
        <span>----- Or -----</span>
        <a href="/STD/create" class="btn btn-primary my-2" align="left">เพิ่มข้อมูล</a>
        
        </div>
      
    </div>
{!! Form::close() !!}
   
   <br />
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">รหัส</th>
      <th scope="col">ชื่อ</th>
      <th scope="col">อีเมล</th>
      <th scope="col">เบอร์โทร</th>
      <th scope="col">ปีการศึกษา</th>
      <th scope="col">หมายเหตุ</th>
      <th scope="col">แก้ไข</th>
      <th scope="col">ลบ</th>
    </tr>
  </thead>
  <tbody>
    {{-- {{ $data_subject }} --}}
      @foreach($data as $row)
    <tr>
      <th scope="row">{{$row->std_code}}</th>
      <td>{{$row->name}}</td>
      <td>{{$row->email}}</td>
      <td>{{$row->phone}}</td>
      <td>{{$row->year_term}}</td>
      <td>{{$row->note}}</td>
      <td><a href="{{route('STD.edit',$row->id)}}" class="btn btn-success">แก้ไข</a></td>
      <td>
          <form action="{{route('STD.destroy',$row->id)}}" method="POST">
              @csrf @method('DELETE')
              <input type="submit" value="ลบ" data-name="{{$row->name}}" class="btn btn-danger deleteForm">
          </form>

        </td>
    </tr>
   
    @endforeach
  </tbody>
</table>
  </div>
 </body>
</html>

@endsection