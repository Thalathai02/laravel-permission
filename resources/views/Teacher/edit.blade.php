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
{!! Form::open(['action' => ['TeacherController@update',$data->id],'method'=>'PUT']) !!}
        <div class="row">
        <div class="form-group col-6">
            {!! Form::label('name')!!}
            {!! Form::text('name',$data->name,["class"=>"form-control"]) !!}
            </div>
            <div class="form-group col-6">
            {!! Form::label('email')!!}
            {!! Form::email('email',$data->email,["class"=>"form-control"]) !!}
            </div>
    
        </div>
        <div class="row">
            <div class="form-group col-2">
                {!! Form::label('Line ID')!!}
                {!! Form::text('lineId',$data->lineId,["class"=>"form-control"]) !!}
                </div>
                <div class="form-group col-6">
                {!! Form::label('facebook')!!}
                {!! Form::text('facebook',$data->facebook,["class"=>"form-control"]) !!}
                </div>
        
            </div>
            <div class="row">
                <div class="form-group col-5">
                    {!! Form::label('phone')!!}
                    {!! Form::text('phone',$data->phone,["class"=>"form-control"]) !!}
                    </div>
                  
            
                </div>

    <input type="submit" value="บันทึก" class="btn btn-primary row-1 " name="" id="">
        
        @if (Auth::user()->hasRole('Admin'))
        <a href="/Teacher" class="btn btn-success row-2">กลับ</a>
        <a href="{{route('User.edit',$data->user_id)}}" class="btn btn-warning">แก้ไขผู้ใช้งาน</a>
        @endif
        @if (Auth::user()->hasRole('Std'))
        <a href="/home" class="btn btn-success row-2">กลับ</a>
        @endif
        @if (Auth::user()->hasRole('Tea'))
        <a href="/home" class="btn btn-success row-2">กลับ</a>
        @endif
       
{!! Form::close() !!}
</div>
@endsection

