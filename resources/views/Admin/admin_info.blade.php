@extends('layouts.app')
@section('content')
    <div class="container">
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
        <div class="row">
            <div class="form-group  col-xl-6 col-lg-6">
                {!! Form::label('name') !!}
                {!! Form::text('name_admin',$data->Title_name_admin.$data->name_admin, ['readonly','class' => 'form-control']) !!}
            </div>
            <div class="form-group  col-xl-6 col-lg-6">
                {!! Form::label('email') !!}
                {!! Form::email('email_admin', $data->email_admin, ['readonly','class' => 'form-control']) !!}
            </div>

        </div>
        <div class="row">
            <div class="form-group  col-xl-3 col-lg-3">
                {!! Form::label('Line ID') !!}
                {!! Form::text('lineId_admin', $data->lineId_admin, ['readonly','class' => 'form-control']) !!}
            </div>
            <div class="form-group  col-xl-6 col-lg-6">
                {!! Form::label('facebook') !!}
                {!! Form::text('facebook_admin', $data->facebook_admin, ['readonly','class' => 'form-control']) !!}
            </div>

        </div>
        <div class="row">
            <div class="form-group  col-xl-6 col-lg-6">
                {!! Form::label('phone') !!}
                {!! Form::text('phone_admin', $data->phone_admin, ['readonly','class' => 'form-control']) !!}
            </div>


        </div>
        
        
    </div>
@endsection
