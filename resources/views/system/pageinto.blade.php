@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>
 <body>
  <br />
  
  <div class="container">
   <h3 align="center">เลือกปีการศึกษา</h3>
    <br />
   
    {!! Form::open(['action' => 'systemController@show','method'=>'POST','enctype'=>"multipart/form-data"]) !!}
    {{ csrf_field() }}
    {!! Form::select('subject', $term,['class' => 'md-6'] ) !!}
    <input type="submit" value="เลือก" class="btn btn-primary  " name="submit_1" id="">
    {!! Form::close() !!}
    
</div>
</body>
</html>

@endsection