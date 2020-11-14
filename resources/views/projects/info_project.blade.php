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
         @if (Auth::user()->hasRole('Admin'))
         <div class="my-2">
            {!! Form::label('name_th','ชื่อโปรเจค(ภาษาไทย)')!!}
            {!! Form::text('Project_name_thai',$datas[0]->name_th,['readonly',"class"=>"form-control"]) !!}
         </div>
         <div class="my-4">
            {!! Form::label('name_eg','ชื่อโปรเจค(ภาษาอังกฤษ)')!!}
            {!! Form::text('Project_name_eg',$datas[0]->name_en,['readonly',"class"=>"form-control"]) !!}
         </div>
         <div class="my-2">
            {!! Form::label('reg_std1','นักศึกษาคนที่ 1*(ตัวแทนกลุ่ม)')!!}
            {!! Form::text('reg_std1',$datas[0]->name,['readonly',"class"=>"form-control col-3"]) !!}
         </div>

         @if(!empty( $datas[1]->name))
         <div class="my-4">
            {!! Form::label('reg_std2','นักศึกษาคนที่ 2')!!}
            {!! Form::text('reg_std2',$datas[1]->name,['readonly',"class"=>"form-control col-3"]) !!}
         @endif
         @if(!empty( $datas[2]->name))
         <div class="my-4">
            {!! Form::label('reg_std3','นักศึกษาคนที่ 3')!!}
            {!! Form::text('reg_std3',$datas[2]->name,['readonly',"class"=>"form-control col-3"]) !!}
         </div>
         @endif
         @if(!empty( $datas[0]->name_Instructor))
         <div class="my-4">
            {!! Form::label('name_president','ชื่อประธาน')!!}
            {!! Form::text('name_president',$datas[0]->name_Instructor,['readonly',"class"=>"form-control col-5"]) !!}
         </div>
         @endif
         @if(!empty( $datas[1]->name_Instructor))
         <div class="my-4">
            {!! Form::label('name_director1','ชื่อกรรมการคนที่ 1')!!}
            {!! Form::text('name_director1',$datas[1]->name_Instructor,['readonly',"class"=>"form-control col-5"]) !!}
         </div>
         @endif
         @if(!empty( $datas[2]->name_Instructor))
         <div class="my-4">
         <div class="my-4">
            {!! Form::label('name_director2','ชื่อกรรมการคนที่ 2')!!}
            {!! Form::text('name_director2',$datas[2]->name_Instructor,['readonly',"class"=>"form-control col-5"]) !!}
         </div>
         @endif
         @if(!empty( $datas[0]->name_mentor))
         <div class="my-4">
            {!! Form::label('name_mentor','ชื่อที่ปรึกษาพิเศษ')!!}
            {!! Form::text('name_mentor',$datas[0]->name_mentor,['readonly',"class"=>"form-control col-5"]) !!}
         </div>
         @endif
         <a href="{!! route('download', $datas[0]->name_file) !!}" download>ดาวน์โหลดเอกสาร</a>
         @endif
      </form>
   </div>
</body>

</html>

@endsection