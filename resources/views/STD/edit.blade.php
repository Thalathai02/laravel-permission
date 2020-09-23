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
{!! Form::open(['action' => ['ImportExcel\ImportExcelController@update',$data->id],'method'=>'PUT']) !!}
    <div class="row">
        <div class="form-group col-4">
        {!! Form::label('std_code','รหัสนักศึกษา')!!}
        {!! Form::text('std_code',$data->std_code,["class"=>"form-control"]) !!}
        </div>
        <div class="form-group col">
        {!! Form::label('name','ชื่อ')!!}
        {!! Form::text('name',$data->name,["class"=>"form-control"]) !!}
        </div>
    </div>
    <div class="row">
    <div class="form-group col-2">
        {!! Form::label('nick_name','ชื่อเล่น')!!}
        {!! Form::text('nick_name',$data->nick_name,["class"=>"form-control"]) !!}
        </div>
        <div class="form-group col-6">
        {!! Form::label('email','อีเมล')!!}
        {!! Form::email('email',$data->email,["class"=>"form-control"]) !!}
        </div>

    </div>
    <input type="submit" value="บันทึก" class="btn btn-primary row-1 " name="" id="">
        
        @if (Auth::user()->hasRole('Admin'))
        <a href="/STD" class="btn btn-success row-2">กลับ</a>
        <a href="{{route('User.edit',$data->user_id)}}" class="btn btn-warning">แก้ไขผู้ใช้งาน</a>
        @endif
        @if (Auth::user()->hasRole('Std'))
        <a href="/home" class="btn btn-success row-2">กลับ</a>
        @endif
       
{!! Form::close() !!}
</div>
@endsection

