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
   <div class="my-2">
      {!! Form::label('reg_std1','รหัสนักศึกษา')!!}
      {!! Form::text('reg_std1',null,["class"=>"form-control"]) !!}
   </div>
   <div class="my-4">
      {!! Form::label('reg_std2','รหัสนักศึกษา2')!!}
      {!! Form::text('reg_std2',null,["class"=>"form-control"]) !!}
   </div>
   <input type="submit" value="บันทึก" class="btn btn-success row-1 " name="" id="">

</div>
</body>
</html>

@endsection