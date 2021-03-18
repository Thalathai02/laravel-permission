@extends('layouts.app')
@section('content')
    <div class="container">

        {!! Form::open(['action' => ['ImportExcel\ImportExcelController@update', $data->id], 'method' => 'PUT']) !!}
        @if (Auth::user()->hasRole('Admin'))
            <br><br><br>
            <div class="row">
                <div class="form-group col-xl-3 col-lg-3">
                    {!! Form::Label('subject_id', 'ปีการศึกษา') !!}
                    {!! Form::select('subject_id', [$subject->year_term, $term],null, ['class' => 'form-select']) !!}
                </div>
                <div class="form-group col-xl-6 col-lg-6 ">
                    {!! Form::label('std_code', 'รหัสนักศึกษา') !!}
                    {!! Form::text('std_code', $data->std_code, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group col-xl-3 col-lg-3 ">
                    {!! Form::label('nick_name', 'ชื่อเล่น') !!}
                    {!! Form::text('nick_name', $data->nick_name, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xl-6 col-lg-6">
                    {!! Form::label('name', 'ขื่อ-นามสกุล') !!}
                    {!! Form::text('name', $data->name, ['class' => 'form-control ']) !!}
                </div>
                <div class="form-group col-xl-6 col-lg-6">
                    {!! Form::label('email', 'อีเมล') !!}
                    {!! Form::email('email', $data->email, ['class' => 'form-control']) !!}
                </div>

            </div>
            <div class="row">
                <div class="form-group col-xl-2 col-lg-2">
                    {!! Form::label('phone', 'เบอร์มือถือ') !!}
                    {!! Form::text('phone', $data->phone, ['class' => 'form-control ']) !!}
                </div>
                <div class="form-group col-4">
                    {!! Form::label('ID-Line') !!}
                    {!! Form::text('lineId', $data->lineId, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group col-xl-6 col-lg-6">
                    {!! Form::label('facebook') !!}
                    {!! Form::text('facebook', $data->facebook, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    {!! Form::label('address', 'ที่อยู่') !!}
                    {!! Form::text('address', $data->address, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xl-6 col-lg-6">
                    {!! Form::label('parent_name', 'ชื่อผู้ปกครอง') !!}
                    {!! Form::text('parent_name', $data->parent_name, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group col-xl-6 col-lg-6">
                    {!! Form::label('parent_phone', 'เบอร์มือถือผู้ปกครอง') !!}
                    {!! Form::text('parent_phone', $data->parent_phone, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xl-6 col-lg-6">
                    {!! Form::label('note', 'หมายเหตุ') !!}
                    {!! Form::text('note', $data->note, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class=" row justify-content-md-center">
                <div class="form-group col-xl-4 col-lg-4">
                    <input type="submit" value="บันทึก" class="my-2 form-control btn btn-primary " name="" id="">
                    <a href="/STD" class="form-control btn btn-success ">กลับ</a>
                    <a href="{{ route('User.edit', $data->user_id) }}"
                        class="my-2 form-control btn btn-warning ">แก้ไขผู้ใช้งาน</a>
                </div>
                
            </div>
            
        @endif
        @if (Auth::user()->hasRole('Std'))
        <div class="row">
            <div class="form-group col-xl-3 col-lg-3">
                {!! Form::Label('subject_id', 'ปีการศึกษา') !!}
                {!! Form::text('subject_id', $subject->year_term, ['readonly','class' => 'form-select']) !!}
            </div>
            <div class="form-group col-xl-6 col-lg-6 ">
                {!! Form::label('std_code', 'รหัสนักศึกษา') !!}
                {!! Form::text('std_code', $data->std_code, ['readonly','class' => 'form-control']) !!}
            </div>
            <div class="form-group col-xl-3 col-lg-3 ">
                {!! Form::label('nick_name', 'ชื่อเล่น') !!}
                {!! Form::text('nick_name', $data->nick_name, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xl-6 col-lg-6">
                {!! Form::label('name', 'ขื่อ-นามสกุล') !!}
                {!! Form::text('name', $data->name, ['readonly','class' => 'form-control ']) !!}
            </div>
            <div class="form-group col-xl-6 col-lg-6">
                {!! Form::label('email', 'อีเมล') !!}
                {!! Form::email('email', $data->email, ['class' => 'form-control']) !!}
            </div>

        </div>
        <div class="row">
            <div class="form-group col-xl-2 col-lg-2">
                {!! Form::label('phone', 'เบอร์มือถือ') !!}
                {!! Form::text('phone', $data->phone, ['class' => 'form-control ']) !!}
            </div>
            <div class="form-group col-xl-4 col-lg-4">
                {!! Form::label('ID-Line') !!}
                {!! Form::text('lineId', $data->lineId, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group col-xl-6 col-lg-6">
                {!! Form::label('facebook') !!}
                {!! Form::text('facebook', $data->facebook, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                {!! Form::label('address', 'ที่อยู่') !!}
                {!! Form::text('address', $data->address, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xl-6 col-lg-6">
                {!! Form::label('parent_name', 'ชื่อผู้ปกครอง') !!}
                {!! Form::text('parent_name', $data->parent_name, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group col-xl-6 col-lg-6">
                {!! Form::label('parent_phone', 'เบอร์มือถือผู้ปกครอง') !!}
                {!! Form::text('parent_phone', $data->parent_phone, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xl-6 col-lg-6">
                {!! Form::label('note', 'หมายเหตุ') !!}
                {!! Form::text('note', $data->note, ['readonly','class' => 'form-control']) !!}
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="form-group col-xl-4 col-lg-4">
              <input type="submit" value="บันทึก" class="btn btn-primary my-2  " name="" id="">
            <a href="/home" class="btn btn-success ">กลับ</a>  
            </div>
            
        </div> 
        @endif

        {!! Form::close() !!}
    </div>
@endsection
