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
        {!! Form::text('username',null,["class"=>"form-control"]) !!}
        </div>
        <div class="form-group col">
            {!! Form::label('password')!!}
            {!! Form::text('password',null,["class"=>"form-control"]) !!}
            </div>
    </div>
    <div class="row">
    <div class="form-group col-6">
        {!! Form::label('name')!!}
        {!! Form::text('name',null,["class"=>"form-control"]) !!}
        </div>
        <div class="form-group col-6">
        {!! Form::label('email')!!}
        {!! Form::email('email',null,["class"=>"form-control"]) !!}
        </div>

    </div>
    <div class="row">
        <div class="form-group col-2">
            {!! Form::label('Line ID')!!}
            {!! Form::text('lineId',null,["class"=>"form-control"]) !!}
            </div>
            <div class="form-group col-6">
            {!! Form::label('facebook')!!}
            {!! Form::text('facebook',null,["class"=>"form-control"]) !!}
            </div>
    
        </div>
        <div class="row">
            <div class="form-group col-5">
                {!! Form::label('phone')!!}
                {!! Form::text('phone',null,["class"=>"form-control"]) !!}
                </div>
              
        
            </div>
    <input type="submit" value="บันทึก" class="btn btn-primary row-1 " name="" id="">
        <a href="/Teacher" class="btn btn-success row-2">กลับ</a>
{!! Form::close() !!}
</div>
@endsection

