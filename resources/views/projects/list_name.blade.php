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
      <P>ชื่อโปรเจค(ภาษาไทย) : {{ Session::get('name_th') }}</P>
      <p>ชื่อโปรเจค(ภาษาอังกฤษ) :{{ Session::get('name_eg') }} </p>

      {!! Form::open(['action' => 'projectControllers@Searchreg1','method'=>'POST']) !!}
      <div class="my-2">
         {!! Form::label('reg_std1','รหัสนักศึกษา')!!}
         {!! Form::text('reg_std1',null,["class"=>"form-control col-3"]) !!}
         <input type="submit" value="ค้นหา" class="btn btn-success row-1 " name="" id="">
         {!! Form::label('reg_std','ชื่อ-นามสกุล')!!} 
       
        
      </div>
      {!! Form::close() !!}
      {{$data ?? ''}}
     
     
      <div class="my-4">
         {!! Form::label('reg_std2','รหัสนักศึกษา2')!!}
         {!! Form::text('reg_std2',null,["class"=>"form-control col-3"]) !!}
         <input type="submit" value="ค้นหา" class="btn btn-success row-1 " name="" id="">
         {!! Form::label('reg_std1','ชื่อ-นามสกุล')!!}
      </div>

      <div class="my-4">
         {!! Form::label('reg_std3','รหัสนักศึกษา3')!!}
         {!! Form::text('reg_std3',null,["class"=>"form-control col-3"]) !!}
         <input type="submit" value="ค้นหา" class="btn btn-success row-1 " name="" id="">
         {!! Form::label('reg_std1','ชื่อ-นามสกุล')!!}
      </div>

      <input type="submit" value="บันทึก" class="btn btn-primary " name="" id="">

   </div>
</body>

</html>

@endsection