@extends('layouts.app')
@section('content')
<div class="container">

{!! Form::open(['action' => ['UserController@update',$data->id],'method'=>'PUT']) !!}
    <div class="row">
        <div class="form-group col-xl-4 col-lg-4">
        {!! Form::label('Username','Username')!!}
        {!! Form::text('username',$data->username,["class"=>"form-control"]) !!}
        </div>
    </div>
    
    @if (Auth::user()->hasRole('Admin'))
    <div class="row">
        <div class="form-group col-xl-6 col-lg-6">
            {!! Form::label('name','ชื่อ')!!}
            {!! Form::text('name',$data->name,['readonly',"class"=>"form-control"]) !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xl-6 col-lg-6">
        {!! Form::label('email')!!}
        {!! Form::email('email',$data->email,['readonly',"class"=>"form-control"]) !!}
        </div>
    </div>
    @endif
    <div class="row">
        <div class="form-group col-xl-6 col-lg-6">
        {!! Form::label('password')!!}
        {!! Form::password('password',["class"=>"form-control"]) !!}
        </div>
    </div>

    <div class="row">
        <div class="form-group col-xl-6 col-lg-6">
        {!! Form::label('New password')!!}
        {!! Form::password('Newpassword',["class"=>"form-control"]) !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xl-6 col-lg-6">
            {!! Form::label('Confirm Password')!!}
            {!! Form::password('ConfirmPassword',["class"=>"form-control"]) !!}
        </div>
    </div>
    <input type="submit" value="บันทึก" class="btn btn-primary row-1 " name="" id="">
        
        @if (Auth::user()->hasRole('Std'))
        <a href="/home" class="btn btn-success row-2">กลับ</a>
        @endif
        @if (Auth::user()->hasRole('Tea'))
        <a href="/home" class="btn btn-success row-2">กลับ</a>
        @endif
        @if (Auth::user()->hasRole('Admin'))
        <a href="/User" class="btn btn-success row-2">กลับ</a>
        @endif
{!! Form::close() !!}
</div>
@endsection

