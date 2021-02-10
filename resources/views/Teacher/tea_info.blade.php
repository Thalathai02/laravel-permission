@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="form-group col-6">
                {!! Form::label('name') !!}
                {!! Form::text('name_Instructor',$data_Instructor->Title_name_Instructor.$data_Instructor->name_Instructor, ['readonly','class' => 'form-control']) !!}
            </div>
            <div class="form-group col-6">
                {!! Form::label('email') !!}
                {!! Form::email('email_Instructor', $data_Instructor->email_Instructor, ['readonly','class' => 'form-control']) !!}
            </div>

        </div>
        <div class="row">
            <div class="form-group col-2">
                {!! Form::label('Line ID') !!}
                {!! Form::text('lineId_Instructor', $data_Instructor->lineId_Instructor, ['readonly','class' => 'form-control']) !!}
            </div>
            <div class="form-group col-6">
                {!! Form::label('facebook') !!}
                {!! Form::text('facebook_Instructor', $data_Instructor->facebook_Instructor, ['readonly','class' => 'form-control']) !!}
            </div>

        </div>
        <div class="row">
            <div class="form-group col-5">
                {!! Form::label('phone') !!}
                {!! Form::text('phone_Instructor', $data_Instructor->phone_Instructor, ['readonly','class' => 'form-control']) !!}
            </div>


        </div>
        
        
    </div>
@endsection
