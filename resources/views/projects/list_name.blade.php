@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>

<body>
   <br />

   <div class="container">
      <h3 align="center">เพิ่มรายชื่อในโปรเจค</h3>
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
      <form action="{{route('project.update',$data_nameProject->id)}}" method="POST">
         @csrf @method('PUT')
         @if (Auth::user()->hasRole('Admin'))
         <P>ชื่อโปรเจค(ภาษาไทย) : {{ $data_nameProject->name_th}}</P>
         <p>ชื่อโปรเจค(ภาษาอังกฤษ) :{{$data_nameProject->name_en}} </p>
         <div class="my-2">
            {!! Form::label('reg_std1','รหัสนักศึกษาคนที่ 1')!!}
            {!! Form::text('reg_std1',null,["class"=>"form-control col-3"]) !!}
         </div>


         <div class="my-4">
            {!! Form::label('reg_std2','รหัสนักศึกษาคนที่ 2 (หากไม่มีให้ใช้ "-")')!!}
            {!! Form::text('reg_std2',null,["class"=>"form-control col-3"]) !!}
         </div>

         <div class="my-4">
            {!! Form::label('reg_std3','รหัสนักศึกษาคนที่ 3 (หากไม่มีให้ใช้ "-")')!!}
            {!! Form::text('reg_std3',null,["class"=>"form-control col-3"]) !!}
         </div>
         <div class="my-4">
            {!! Form::label('name_president','ชื่อประธาน')!!}
            {!! Form::text('name_president',null,["class"=>"form-control col-5"]) !!}
         </div>
         <div class="my-4">
            {!! Form::label('name_director1','ชื่อกรรมการคนที่ 1')!!}
            {!! Form::text('name_director1',null,["class"=>"form-control col-5"]) !!}
         </div>
         <div class="my-4">
            {!! Form::label('name_director2','ชื่อกรรมการคนที่ 2')!!}
            {!! Form::text('name_director2',null,["class"=>"form-control col-5"]) !!}
         </div>
         <div class="my-4">
            {!! Form::label('name_mentor','ชื่อที่ปรึกษาพิเศษ')!!}
            {!! Form::text('name_mentor',null,["class"=>"form-control col-5"]) !!}
         </div>
         {{-- <input type="submit" value="ยืนยัน" data-name=reg_std1 class="btn btn-danger updateProject"> --}}
         {!!Form::submit('ยืนยัน',["class"=>"btn btn-danger updateProject"]); !!}
         @endif

         @if (Auth::user()->hasRole('Std'))
         <P>ชื่อโปรเจค(ภาษาไทย) : {{ $data_nameProject->name_th}}</P>
         <p>ชื่อโปรเจค(ภาษาอังกฤษ) :{{$data_nameProject->name_en}} </p>
         <div class="my-2">
            {!! Form::label('reg_std1','รหัสนักศึกษาคนที่ 1')!!}
            {!! Form::text('reg_std1',$term[0]->std_code,['readonly',"class"=>"form-control col-3"],) !!}
         </div>


         <div class="my-4">
            {!! Form::label('reg_std2','รหัสนักศึกษาคนที่ 2 (หากไม่มีให้ใช้ "-")')!!}
            {!! Form::text('reg_std2',null,["class"=>"form-control col-3"]) !!}
         </div>

         <div class="my-4">
            {!! Form::label('reg_std3','รหัสนักศึกษาคนที่ 3 (หากไม่มีให้ใช้ "-")')!!}
            {!! Form::text('reg_std3',null,["class"=>"form-control col-3"]) !!}
         </div>
         <div class="my-4">
            {!! Form::label('name_president','ชื่อประธาน')!!}
            {!! Form::text('name_president',null,["class"=>"form-control col-5"]) !!}
         </div>
         <div class="my-4">
            {!! Form::label('name_director1','ชื่อกรรมการคนที่ 1')!!}
            {!! Form::text('name_director1',null,["class"=>"form-control col-5"]) !!}
         </div>
         <div class="my-4">
            {!! Form::label('name_director2','ชื่อกรรมการคนที่ 2')!!}
            {!! Form::text('name_director2',null,["class"=>"form-control col-5"]) !!}
         </div>
         <div class="my-4">
            {!! Form::label('name_mentor','ชื่อที่ปรึกษาพิเศษ')!!}
            {!! Form::text('name_mentor',null,["class"=>"form-control col-5"]) !!}
         </div>
         {{-- <input type="submit" value="ยืนยัน" data-name=reg_std1 class="btn btn-danger updateProject"> --}}
         {!!Form::submit('ยืนยัน',["class"=>"btn btn-danger updateProject"]); !!}
         @endif
      </form>
   </div>
</body>

</html>

@endsection