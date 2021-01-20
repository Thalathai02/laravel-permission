@extends('layouts.app')
@section('content')
<div class="container">
{!! Form::open(['action' => 'ImportExcel\ImportExcelController@store','method'=>'POST']) !!}
    <div class="row">
        <div class="form-  col-4">
        {!! Form::label('std_code')!!}
        {!! Form::text('std_code',null,["class"=>"form-control"]) !!}
        {!! Form::Label('subject_id','ปีการศึกษา:') !!}
        {!! Form::select('subject_id', $term,["class"=>"form-control col-6"] ) !!}
        </div>
        <div class="form-group col">
        {!! Form::label('Username')!!}
        {!! Form::text('username',null,["class"=>"form-control"]) !!}
        </div>
    </div>
    <div class="row">
    <div class="form-group col-2">
        {!! Form::label('name')!!}
        {!! Form::text('name',null,["class"=>"form-control"]) !!}
        </div>
        <div class="form-group col-6">
        {!! Form::label('email')!!}
        {!! Form::email('email',null,["class"=>"form-control"]) !!}
        </div>

    </div>
    <input type="submit" value="บันทึก" class="btn btn-primary row-1 " name="" id="">
        <a href="/STD" class="btn btn-success row-2">กลับ</a>
{!! Form::close() !!}
</div>
@endsection

