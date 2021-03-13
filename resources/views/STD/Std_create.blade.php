@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>

    <body>
        <div class="container">
            {!! Form::open(['action' => 'ImportExcel\ImportExcelController@store', 'method' => 'POST']) !!}
            <div class="row">
                <div class="form-group col-xl-6 col-lg-6">
                    {!! Form::label('Username') !!}
                    {!! Form::text('username', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group col-xl-6 col-lg-6">
                    {!! Form::label('password') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                
            </div>
            <div class="row">
                <div class="form-group col-xl-3 col-lg-3" >
                    {!! Form::Label('subject_id', 'ปีการศึกษา') !!}
                    {!! Form::select('subject_id', $term,null, ['class' => 'form-select']) !!}
                </div>
                <div class="form-group col-xl-6 col-lg-6 ">
                    {!! Form::label('std_code','รหัสนักศึกษา') !!}
                    {!! Form::text('std_code', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group col-xl-3 col-lg-3 ">
                    {!! Form::label('nick_name','ชื่อเล่น') !!}
                    {!! Form::text('nick_name', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xl-6 col-lg-6">
                    {!! Form::label('name','ขื่อ-นามสกุล') !!}
                    {!! Form::text('name', null, ['class' => 'form-control ']) !!}
                </div>
                <div class="form-group col-xl-6 col-lg-6">
                    {!! Form::label('email','อีเมล') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>

            </div>
            <div class="row">
                <div class="form-group col-xl-2 col-lg-2" >
                    {!! Form::label('phone','เบอร์มือถือ') !!}
                    {!! Form::text('phone', null, ['class' => 'form-control ']) !!}
                </div>
                <div class="form-group col-xl-4 col-lg-4" >
                    {!! Form::label('ID-Line') !!}
                    {!! Form::text('lineId', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group col-xl-6 col-lg-6" >
                    {!! Form::label('facebook') !!}
                    {!! Form::text('facebook', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    {!! Form::label('address', 'ที่อยู่') !!}
                    {!! Form::text('address','', ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xl-6 col-lg-6" >
                    {!! Form::label('parent_name','ชื่อผู้ปกครอง') !!}
                    {!! Form::text('parent_name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group col-xl-6 col-lg-6" >
                    {!! Form::label('parent_phone','เบอร์มือถือผู้ปกครอง') !!}
                    {!! Form::text('parent_phone', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xl-6 col-lg-6" >
                    {!! Form::label('note','หมายเหตุ') !!}
                    {!! Form::text('note', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <input type="submit" value="บันทึก" class="btn btn-primary row-1 " name="" id="">
            <a href="/STD" class="btn btn-success row-2">กลับ</a>
            {!! Form::close() !!}
        </div>
    </body>

    </html>

@endsection
