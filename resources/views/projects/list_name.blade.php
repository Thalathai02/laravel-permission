@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <br />

        <div class="container">
            <h3 align="center">เพิ่มรายชื่อในโปรเจค</h3>
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
            <form action="{{ route('project.update', $data_nameProject->id) }}" method="POST">
                @csrf @method('PUT')
                @if (Auth::user()->hasRole('Admin'))
                    <P>ชื่อโปรเจค(ภาษาไทย) : {{ $data_nameProject->name_th }}</P>
                    <p>ชื่อโปรเจค(ภาษาอังกฤษ) :{{ $data_nameProject->name_en }} </p>
                    <div class="my-2 row-1">
                        {!! Form::label('reg_std1', 'รหัสนักศึกษาคนที่ 1') !!}
                        <div class="row">
                            {!! Form::text('reg_std1', null, ['class' => 'form-control col-3']) !!}
                            <div id="name_reg1" class="col-3"></div>
                        </div>
                    </div>

                    <div class="my-4">
                        {!! Form::label('reg_std2', 'รหัสนักศึกษาคนที่ 2') !!}
                        <div class="row">
                            {!! Form::text('reg_std2', null, ['class' => 'form-control col-3']) !!}
                            <div id="name_reg2" class="col-3"></div>
                        </div>
                    </div>

                    <div class="my-4">
                        {!! Form::label('reg_std3', 'รหัสนักศึกษาคนที่ 3') !!}
                        <div class="row">
                            {!! Form::text('reg_std3', null, ['class' => 'form-control col-3']) !!}
                            <div id="name_reg3" class="col-3"></div>
                        </div>
                    </div>

                    <div class="my-4">
                        {!! Form::label('name_president', 'ชื่อประธาน') !!}
                        {!! Form::select('name_president',array_merge(['-' => 'Please Select',$name_Instructor]),  ['class' => ' col-8']) !!}
                    </div>
                    <div class="my-4">
                        {!! Form::label('name_director1', 'ชื่อกรรมการคนที่ 1') !!}
                        {!! Form::select('name_director1', array_merge(['-' => 'Please Select',$name_Instructor]), ['class' => ' col-8']) !!}
                    </div>
                    <div class="my-4">
                        {!! Form::label('name_director2', 'ชื่อกรรมการคนที่ 2') !!}
                        {!! Form::select('name_director2', array_merge(['-' => 'Please Select',$name_Instructor]), ['class' => ' col-8']) !!}
                    </div>
                    <div class="my-4">
                        {!! Form::label('name_mentor', 'ชื่อที่ปรึกษาพิเศษ') !!}
                        {!! Form::text('name_mentor', null, ['class' => 'form-control col-5']) !!}
                    </div>

                    {!! Form::submit('ยืนยัน', ['class' => 'btn btn-danger updateProject']) !!}
                @endif

                @if (Auth::user()->hasRole('Std'))
                    <P>ชื่อโปรเจค(ภาษาไทย) : {{ $data_nameProject->name_th }}</P>
                    <p>ชื่อโปรเจค(ภาษาอังกฤษ) :{{ $data_nameProject->name_en }} </p>
                    <div class="my-2">
                        {!! Form::label('reg_std1', 'รหัสนักศึกษาคนที่ 1') !!}
                        {!! Form::text('reg_std1', $term[0]->std_code, ['readonly', 'class' => 'form-control col-3']) !!}
                    </div>



                    <div class="my-4">
                        {!! Form::label('reg_std2', 'รหัสนักศึกษาคนที่ 2') !!}
                        <div class="row">
                            {!! Form::text('reg_std2', null, ['class' => 'form-control col-3']) !!}
                            <div id="name_reg2" class="col-3"></div>
                        </div>
                    </div>

                    <div class="my-4">
                        {!! Form::label('reg_std3', 'รหัสนักศึกษาคนที่ 3') !!}
                        <div class="row">
                            {!! Form::text('reg_std3', null, ['class' => 'form-control col-3']) !!}
                            <div id="name_reg3" class="col-3"></div>
                        </div>
                    </div>
                    <div class="my-4">
                        {!! Form::label('name_mentor', 'ชื่อที่ปรึกษาพิเศษ') !!}
                        {!! Form::text('name_mentor', null, ['class' => 'form-control col-5']) !!}
                    </div>

                    {!! Form::submit('ยืนยัน', ['class' => 'btn btn-danger updateProject']) !!}
                @endif
            </form>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#reg_std1').on('keyup', function() {
                    var query = $(this).val();
                    $.ajax({
                        url: "{{ route('action') }}",
                        type: "GET",
                        data: {
                            'reg_std': query
                        },
                        success: function(data) {
                            $('#name_reg1').html(data);
                        }
                    })
                });


                $('#reg_std2').on('keyup', function() {
                    var query = $(this).val();
                    $.ajax({
                        url: "{{ route('action') }}",
                        type: "GET",
                        data: {
                            'reg_std': query
                        },
                        success: function(data) {
                            $('#name_reg2').html(data);
                        }
                    })
                });


                $('#reg_std3').on('keyup', function() {
                    var query = $(this).val();
                    $.ajax({
                        url: "{{ route('action') }}",
                        type: "GET",
                        data: {
                            'reg_std': query
                        },
                        success: function(data) {
                            $('#name_reg3').html(data);
                        }
                    })
                });


                $(document).on('click', 'li', function() {

                    var value = $(this).text();
                    $('#reg_std1').val(value);
                    $('#name_reg1').html("");

                    $('#reg_std2').val(value);
                    $('#name_reg2').html("");

                    $('#reg_std2').val(value);
                    $('#name_reg2').html("");
                });
            });

        </script>
    </body>

    </html>

@endsection
