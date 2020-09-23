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
{!! Form::open(['action' => 'subjects@store','method'=>'POST']) !!}
    <div class="row">
        <div class="form-group col-4">
        {!! Form::label('year','ปีการศึกษา')!!}
        {{ Form::selectYear('year', 2561, 2570) }}
        </div>
        <div class="form-group col">
        {!! Form::label('term','เทอมการศึกษา')!!}
        {!! Form::select('term', ['1' => '1', '2' => '2'], '1') !!}
        </div>
    </div>

    <input type="submit" value="บันทึก" class="btn btn-primary row-1 " name="" id="">
        <a href="/STD" class="btn btn-success row-2">กลับ</a>
{!! Form::close() !!}
</div>
@endsection

