@extends('layouts.app')
@section('content')
    <div class="container">
        
        {!! Form::open(['action' => ['AdminController@update', $data->id], 'method' => 'PUT','enctype' =>
        'multipart/form-data']) !!}
        {{ csrf_field() }}
        <div class="row  ">
            <div style=" text-align: center">
                @isset($data->avatar)
                <img class="img-profile rounded-circle" width="360px" height="360px"
                src="{{asset("storage/avatar/".$data->avatar)}}">
                @else
                <img class="img-profile rounded-circle" width="360px" height="360px"
                src="{{ asset("img/undraw_profile.svg")}}">
                @endisset
            </div>
        </div>
        <br>
        <div class="row">
            <div class="form-group  col-xl-6 col-lg-6">
                {!! Form::label('Title_name') !!}
                {!! Form::text('Title_name_admin', $data->Title_name_admin, ['class' => 'form-control']) !!}
                {!! Form::label('name') !!}
                {!! Form::text('name_admin', $data->name_admin, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group  col-xl-6 col-lg-6">
                {!! Form::label('email') !!}
                {!! Form::email('email_admin', $data->email_admin, ['class' => 'form-control']) !!}
            </div>

        </div>
        <div class="row">
            <div class="form-group  col-xl-6 col-lg-6">
                {!! Form::label('Line ID') !!}
                {!! Form::text('lineId_admin', $data->lineId_admin, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group  col-xl-6 col-lg-6">
                {!! Form::label('facebook') !!}
                {!! Form::text('facebook_admin', $data->facebook_admin, ['class' => 'form-control']) !!}
            </div>

        </div>
        <div class="row">
            <div class="form-group  col-xl-6 col-lg-6">
                {!! Form::label('phone') !!}
                {!! Form::text('phone_admin', $data->phone_admin, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="row">

            <div class="form-group col-xl-6 col-lg-6">
                {!! Form::label('note', 'รูปประจำตัว (อัปโหลดได้เป็น .jpg,.png เท่านั้น)') !!}
                <br>
                {!! Form::file('avatar', ['class' => 'form-control col-5']) !!}
            </div>
        </div>

        <input type="submit" value="บันทึก" class="btn btn-primary row-1 " name="" id="">

        @if (Auth::user()->hasRole('Admin'))
            <a href="/Teacher" class="btn btn-success row-2">กลับ</a>
            <a href="{{ route('User.edit', $data->user_id_admin) }}" class="btn btn-warning">แก้ไขผู้ใช้งาน</a>
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
