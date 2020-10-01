@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>
 <body>
  <br />
  
  <div class="container">
   <h3 align="center">เลือกปีการศึกษา</h3>
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
    {!! Form::open(['action' => 'systemController@show','method'=>'POST','enctype'=>"multipart/form-data"]) !!}
    {{ csrf_field() }}
    {!! Form::select('subject', $term,['class' => 'md-6'] ) !!}
    <input type="submit" value="เลือก" class="btn btn-primary  " name="submit_1" id="">
    {!! Form::close() !!}
    
</div>
</body>
</html>

@endsection