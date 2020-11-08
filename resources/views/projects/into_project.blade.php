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
      {!! Form::open(['action' => 'projectControllers@createNameProject','method'=>'POST']) !!}
       {!! Form::select('subject', $term,['class' => 'md-6'] ) !!}
      <div class="my-2">
         {!! Form::label('name_th','ชื่อโปรเจค(ภาษาไทย)')!!}
         {!! Form::text('Project_name_thai',null,["class"=>"form-control"]) !!}
      </div>
      <div class="my-4">
         {!! Form::label('name_eg','ชื่อโปรเจค(ภาษาอังกฤษ)')!!}
         {!! Form::text('Project_name_eg',null,["class"=>"form-control"]) !!}
      </div>
    
      <input type="submit" value="ถัดไป" class="btn btn-primary col-2 " name="submit" id="">
      {!! Form::close() !!}
   </div>
</body>

</html>

@endsection