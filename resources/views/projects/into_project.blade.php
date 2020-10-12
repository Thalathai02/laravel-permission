@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>
 <body>
  <br />
  
  <div class="container">
   <h3 align="center">สร้างโปรเจค</h3>
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
      {!! Form::label('name_th','ชื่อโปรเจค(ภาษาไทย)')!!}
      {!! Form::text('name_th',null,["class"=>"form-control"]) !!}
   </div>
   <div class="my-4">
      {!! Form::label('name_eg','ชื่อโปรเจค(ภาษาอังกฤษ)')!!}
      {!! Form::text('name_eg',null,["class"=>"form-control"]) !!}
   </div>
   {{-- <input type="submit" value="ถัดไป" class="btn btn-success row-1 "  name="" id=""> --}}
<a href="/projects/list_name">ถัดไป</a>

</div>
</body>
</html>

@endsection