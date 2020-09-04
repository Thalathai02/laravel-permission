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
{!! Form::open(['action' => ['UserController@update',$data->id],'method'=>'PUT']) !!}
    <div class="row">
        <div class="form-group col-4">
        {!! Form::label('std_code','Username')!!}
        {!! Form::text('std_code',$data->username,["class"=>"form-control"]) !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-6">
            {!! Form::label('name','ชื่อ')!!}
            {!! Form::text('name',$data->name,["class"=>"form-control"]) !!}
        </div>
    </div><div class="row">
        <div class="form-group col-6">
        {!! Form::label('email')!!}
        {!! Form::text('password',$data->email,["class"=>"form-control"]) !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-6">
        {!! Form::label('password')!!}
        {!! Form::text('password',$data->password,["class"=>"form-control"]) !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-6">
            {!! Form::label('Confirm Password')!!}
            {!! Form::text('Confirm Password',null,["class"=>"form-control"]) !!}
        </div>
    </div>
    <input type="submit" value="บันทึก" class="btn btn-primary row-1 " name="" id="">
        
        @if (Auth::user()->hasRole('Std'))
        <a href="/home" class="btn btn-success row-2">กลับ</a>
        @endif
        @if (Auth::user()->hasRole('Admin'))
        <a href="/STD" class="btn btn-success row-2">กลับ</a>
        @endif
{!! Form::close() !!}
</div>
@endsection

