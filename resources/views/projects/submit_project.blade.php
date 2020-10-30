@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <br />

        <div class="container">
            <h3 align="center">ยืนยันการส่งการส่งโปรเจค</h3>
            <br />
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="my-2">
                {!! Form::label('reg_std1', 'รหัสนักศึกษาคนที่ 1') !!}
                @foreach ($data as $datas)
                {!! Form::label('reg_code_std1', $datas->std_code) !!}
                {!! Form::label('reg_name_std1', $datas->name) !!}
                @endforeach
            </div>
{{-- {{{$data_project}}} --}}

            <div class="my-4">
                {!! Form::label('reg_std2', 'รหัสนักศึกษาคนที่ 2') !!}
                @foreach ($data2 as $datas)
                {!! Form::label('reg_code_std2', $datas->std_code) !!}
                {!! Form::label('reg_name_std2', $datas->name) !!}

                @endforeach
            </div>

            <div class="my-4">
                {!! Form::label('reg_std3', 'รหัสนักศึกษาคนที่ 3') !!}
                @foreach ($data3 as $datas)
                {!! Form::label('reg_code_std3', $datas->std_code) !!}
                {!! Form::label('reg_name_std3', $datas->name) !!}
            @endforeach
            </div>
            <div class="my-4">
                {!! Form::label('name_president', 'ชื่อประธาน') !!}
                @foreach ($name_president as $datas)
                {!! Form::label('id_president', $datas->id) !!}
                {!! Form::label('name_president', $datas->name) !!}
            @endforeach
            </div>
            <div class="my-4">
                {!! Form::label('name_director1', 'ชื่อกรรมการคนที่ 1') !!}
                @foreach ($name_director1 as $datas)
                {!! Form::label('id_director1', $datas->id) !!}
                {!! Form::label('name_director1', $datas->name) !!}
            @endforeach
            </div>
            <div class="my-4">
                {!! Form::label('name_director2', 'ชื่อกรรมการคนที่ 2') !!}
                @foreach ($name_director2 as $datas)
                {!! Form::label('id_director2', $datas->id) !!}
                {!! Form::label('name_director2', $datas->name) !!}
            @endforeach
            </div>
            <input type="submit" value="ยืนยัน" class="btn btn-primary " name="" id="">
        </div>
    </body>

    </html>

@endsection
