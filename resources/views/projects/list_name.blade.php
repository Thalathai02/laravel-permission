@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <br />

        <div class="container">
            <h3 align="center">เพิ่มรายชื่อในโปรเจค</h3>
            <br />

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
                        {!! Form::label('reg_std2', 'รหัสนักศึกษาคนที่ 2 (หากไม่มีให้ใส่ - )') !!}
                        <div class="row">
                            {!! Form::text('reg_std2', null, ['class' => 'form-control col-3']) !!}
                            <div id="name_reg2" class="col-3"></div>
                        </div>
                    </div>

                    <div class="my-4">
                        {!! Form::label('reg_std3', 'รหัสนักศึกษาคนที่ 3 (หากไม่มีให้ใส่ - )') !!}
                        <div class="row">
                            {!! Form::text('reg_std3', null, ['class' => 'form-control col-3']) !!}
                            <div id="name_reg3" class="col-3"></div>
                        </div>
                    </div>


                    <div class="my-4">
                        {!! Form::label('name_mentor', 'ชื่อที่ปรึกษาพิเศษ (หากไม่มีให้ใส่ - )') !!}
                        {!! Form::text('name_mentor', null, ['class' => 'form-control col-5']) !!}
                    </div>

                    {!! Form::submit('ยืนยัน', ['class' => 'btn btn-danger updateProject']) !!}
                @endif

                @if (Auth::user()->hasRole('Std'))
                    <P>ชื่อโปรเจค(ภาษาไทย) : {{ $data_nameProject->name_th }}</P>
                    <p>ชื่อโปรเจค(ภาษาอังกฤษ) :{{ $data_nameProject->name_en }} </p>
                    <div class="my-4">
                        {!! Form::label('reg_std1', 'รหัสนักศึกษาคนที่ 1') !!}
                        <div class="row">
                            {!! Form::text('reg_std1', $term[0]->std_code, ['readonly', 'class' => 'form-control col-3']) !!}
                        </div>
                    </div>



                    <div class="my-4">
                        {!! Form::label('reg_std2', 'รหัสนักศึกษาคนที่ 2 (หากไม่มีให้ใส่ - )') !!}
                        <div class="row">
                            {!! Form::text('reg_std2', null, ['class' => 'form-control col-3']) !!}
                            <div id="name_reg2" class="col-3"></div>
                        </div>
                    </div>

                    <div class="my-4">
                        {!! Form::label('reg_std3', 'รหัสนักศึกษาคนที่ 3 (หากไม่มีให้ใส่ - )') !!}
                        <div class="row">
                            {!! Form::text('reg_std3', null, ['class' => 'form-control col-3']) !!}
                            <div id="name_reg3" class="col-3"></div>
                        </div>
                    </div>
                    <div class="my-4">
                        {!! Form::label('name_mentor', 'ชื่อที่ปรึกษาพิเศษ (หากไม่มีให้ใส่ - )') !!}
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
