@extends('layouts.app')
@section('content')
    <div class="container">

        @auth
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
                <div class="form-group col-xl-3 col-lg-3">
                    {!! Form::Label('subject_id', 'ปีการศึกษา') !!}
                    {!! Form::text('subject_id', $subject->year_term, ['readonly','class' => 'form-control']) !!}
                </div>
                <div class="form-group col-xl-6 col-lg-6 ">
                    {!! Form::label('std_code', 'รหัสนักศึกษา') !!}
                    {!! Form::text('std_code', $data->std_code, ['readonly','class' => 'form-control']) !!}
                </div>
                <div class="form-group col-xl-3 col-lg-3 ">
                    {!! Form::label('nick_name', 'ชื่อเล่น') !!}
                    {!! Form::text('nick_name', $data->nick_name, ['readonly','class' => 'form-control']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xl-6 col-lg-6">
                    {!! Form::label('name', 'ขื่อ-นามสกุล') !!}
                    {!! Form::text('name', $data->name, ['readonly','class' => 'form-control ']) !!}
                </div>
                <div class="form-group col-xl-6 col-lg-6">
                    {!! Form::label('email', 'อีเมล') !!}
                    {!! Form::email('email', $data->email, ['readonly','class' => 'form-control']) !!}
                </div>

            </div>
            <div class="row">
                <div class="form-group col-xl-2 col-lg-2">
                    {!! Form::label('phone', 'เบอร์มือถือ') !!}
                    {!! Form::text('phone', $data->phone, ['readonly','class' => 'form-control ']) !!}
                </div>
                <div class="form-group col-4">
                    {!! Form::label('ID-Line') !!}
                    {!! Form::text('lineId', $data->lineId, ['readonly','class' => 'form-control']) !!}
                </div>
                <div class="form-group col-xl-6 col-lg-6">
                    {!! Form::label('facebook') !!}
                    {!! Form::text('facebook', $data->facebook, ['readonly','class' => 'form-control']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    {!! Form::label('address', 'ที่อยู่') !!}
                    {!! Form::text('address', $data->address, ['readonly','class' => 'form-control']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xl-6 col-lg-6">
                    {!! Form::label('parent_name', 'ชื่อผู้ปกครอง') !!}
                    {!! Form::text('parent_name', $data->parent_name, ['readonly','class' => 'form-control']) !!}
                </div>
                <div class="form-group col-xl-6 col-lg-6">
                    {!! Form::label('parent_phone', 'เบอร์มือถือผู้ปกครอง') !!}
                    {!! Form::text('parent_phone', $data->parent_phone, ['readonly','class' => 'form-control']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xl-6 col-lg-6">
                    {!! Form::label('note', 'หมายเหตุ') !!}
                    {!! Form::text('note', $data->note, ['readonly','class' => 'form-control']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xl-6 col-lg-6" >
                    {!! Form::label('Internship_score','คะแนนฝึกงาน') !!}
                    {!! Form::number('Internship_score', $data->Internship_score, ['readonly','class' => 'form-control','step' => '0.1']) !!}
                </div>
                <div class="form-group col-xl-6 col-lg-6" >
                    {!! Form::label('gpa','เกรด') !!}
                    {!! Form::number('gpa', $data->gpa, ['readonly','class' => 'form-control','step' => '0.1']) !!}
                </div>
            </div>
        @endauth
    </div>
@endsection
