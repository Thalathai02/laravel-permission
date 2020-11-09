@extends('layouts.app')
@section('content')
<div class="container">
@if($errors->all())
<ul class="alert alert-danger">
    @foreach($errors->all() as $error)  
    <li>
    {{$error}}
    </li>
    @endforeach
</ul>
@endif
{!! Form::open(['action' => 'TeacherController@store','method'=>'POST']) !!}
    <div class="row">
        <div class="form-group col">
        {!! Form::label('Username')!!}
        {!! Form::text('username_Instructor',null,["class"=>"form-control"]) !!}
        </div>
        <div class="form-group col">
            {!! Form::label('password')!!}
            {!! Form::text('password_Instructor',null,["class"=>"form-control"]) !!}
            </div>
    </div>
    <div class="row">
    <div class="form-group col-6">
        {!! Form::label('name')!!}
        {!! Form::text('name_Instructor',null,["class"=>"form-control"]) !!}
        </div>
        <div class="form-group col-6">
        {!! Form::label('email')!!}
        {!! Form::email('email_Instructor',null,["class"=>"form-control"]) !!}
        </div>

    </div>
    <div class="row">
        <div class="form-group col-2">
            {!! Form::label('Line ID')!!}
            {!! Form::text('lineId_Instructor',null,["class"=>"form-control"]) !!}
            </div>
            <div class="form-group col-6">
            {!! Form::label('facebook')!!}
            {!! Form::text('facebook_Instructor',null,["class"=>"form-control"]) !!}
            </div>
    
        </div>
        <div class="row">
            <div class="form-group col-5">
                {!! Form::label('phone')!!}
                {!! Form::text('phone_Instructor',null,["class"=>"form-control"]) !!}
                </div>
              
        
            </div>
    <input type="submit" value="บันทึก" class="btn btn-primary row-1 " name="" id="">
        <a href="/Teacher" class="btn btn-success row-2">กลับ</a>
{!! Form::close() !!}
</div>
@endsection

