@extends('layouts.app')
@section('content')
    <div class="container">
        
        {!! Form::open(['action' => 'AdminController@store', 'method' => 'POST']) !!}
        <div class="row">
            <div class="form-group  col-xl-6 col-lg-6">
                {!! Form::label('Username') !!}
                {!! Form::text('username_admin', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group  col-xl-6 col-lg-6">
                {!! Form::label('password') !!}
                {!! Form::text('password_admin', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="row">
            <div class="form-group  col-xl-3 col-lg-3">
                {!! Form::label('Title_name') !!}
                {!! Form::text('Title_name_admin', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group  col-xl-6 col-lg-6">
                {!! Form::label('name') !!}
                {!! Form::text('name_admin', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group  col-xl-6 col-lg-6">
                {!! Form::label('email') !!}
                {!! Form::email('email_admin', null, ['class' => 'form-control']) !!}
            </div>

        </div>
        <div class="row">
            <div class="form-group  col-xl-2 col-lg-2">
                {!! Form::label('Line ID') !!}
                {!! Form::text('lineId_admin', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group  col-xl-6 col-lg-6">
                {!! Form::label('facebook') !!}
                {!! Form::text('facebook_admin', null, ['class' => 'form-control']) !!}
            </div>

        </div>
        <div class="row">
            <div class="form-group  col-xl-5 col-lg-5">
                {!! Form::label('phone') !!}
                {!! Form::text('phone_admin', null, ['class' => 'form-control']) !!}
            </div>


        </div>
        <input type="submit" value="บันทึก" class="btn btn-primary row-1 " name="" id="">
        <a href="/admin" class="btn btn-success row-2">กลับ</a>
        {!! Form::close() !!}
    </div>
@endsection
