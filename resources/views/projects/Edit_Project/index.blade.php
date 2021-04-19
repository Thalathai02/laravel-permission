@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <br />

        <div class="container">
            <h3 align="center">แก้ไขโปรเจค</h3>
            <br />
            @if (Auth::user()->hasRole('Admin'))
            {!! Form::open(['action' => ['projectControllers@edit_project',$datas[0]->id], 'method' => 'POST', 'enctype' =>
            'multipart/form-data']) !!}
            
                <div class="my-2">
                    {!! Form::label('name_th', 'ชื่อโปรเจค(ภาษาไทย)') !!}
                    {!! Form::text('Project_name_thai', $datas[0]->name_th, ['class' => 'form-control col-xl-6 col-lg-6']) !!}
                </div>
                <div class="my-4">
                    {!! Form::label('name_eg', 'ชื่อโปรเจค(ภาษาอังกฤษ)') !!}
                    {!! Form::text('Project_name_eg', $datas[0]->name_en, ['class' => 'form-control col-xl-6 col-lg-6']) !!}
                </div>
                @if (!empty($datas_std[0]->name))
                <div class="my-2 row">
                {!! Form::label('reg_std1', 'รหัสนักศึกษาคนที่ 1') !!}
                <div class="row">
                    <div class="col-xl-3 col-lg-3">
                        {!! Form::text('reg_std1', $datas_std[0]->std_code, ['class' => 'form-control ']) !!}
                    </div>
                   
                    <div id="name_reg1" class="col-xl-3 col-lg-3"></div>
                </div>
                </div>
                @endif

                @if (!empty($datas_std[1]->name))
                <div class="my-4">
                    {!! Form::label('reg_std2', 'รหัสนักศึกษาคนที่ 2') !!}
                    <div class="row">
                        <div class="col-xl-3 col-lg-3">
                            {!! Form::text('reg_std2', $datas_std[1]->std_code, ['class' => 'form-control']) !!}
                        </div>
                        <a href="{{ route('destroy_edit_name_project', $datas_std[1]->std_code) }}" class="btn btn-danger col-xl-1 col-lg-1">ลบรายชื่อ</a>
                        <div id="name_reg2" class="col-xl-3 col-lg-3"></div>
                    </div>
                </div>
                
                @else
                <div class="my-4">
                    {!! Form::label('reg_std2', 'รหัสนักศึกษาคนที่ 2') !!}
                    <div class="row">
                        <div class="col-xl-3 col-lg-3">
                            {!! Form::text('reg_std2',null, ['class' => 'form-control']) !!}
                        </div>
                        <div id="name_reg2" class="col-xl-3 col-lg-3"></div>
                    </div>
                </div>
                @endif
                @if (!empty($datas_std[2]->name))
                <div class="my-4">
                    {!! Form::label('reg_std3', 'รหัสนักศึกษาคนที่ 3') !!}
                    <div class="row">
                        <div class="col-xl-3 col-lg-3">
                            {!! Form::text('reg_std3', $datas_std[2]->std_code, ['class' => 'form-control']) !!}
                        </div>
                        <a href="{{ route('destroy_edit_name_project', $datas_std[2]->std_code) }}" class="btn btn-danger col-xl-1 col-lg-1">ลบรายชื่อ</a>
                        <div id="name_reg2" class="col-xl-3 col-lg-3"></div>>
                    </div>
                </div>
                @else
                <div class="my-4">
                    {!! Form::label('reg_std3', 'รหัสนักศึกษาคนที่ 3') !!}
                    <div class="row">
                        <div class="col-xl-3 col-lg-3">
                            {!! Form::text('reg_std3',null, ['class' => 'form-control']) !!}
                        </div>
                        <div id="name_reg3" class="col-xl-3 col-lg-3"></div>
                    </div>
                </div>
                @endif
                @if (!empty($datas_instructor[0]->name_Instructor) && $datas_instructor[0]->name_Instructor)
                    <div class="my-4">
                        {!! Form::label('name_president', 'ชื่อประธาน') !!}
                        {!! Form::select('name_president',  array_merge([$datas_instructor[0]->name_Instructor,$name_Instructor]), ['class' => ' col-xl-8 col-lg-8 form-select']) !!}
                    </div>
                @endif
                @if (!empty($datas_instructor[1]->name_Instructor))
                    <div class="my-4">
                        {!! Form::label('name_director1', 'ชื่อกรรมการคนที่ 1') !!}
                        {!! Form::select('name_director1',  array_merge([$datas_instructor[1]->name_Instructor,$name_Instructor]), ['class' => ' col-xl-8 col-lg-8 form-select']) !!}
                    </div>
                @endif
                @if (!empty($datas_instructor[2]->name_Instructor))
                    <div class="my-4">
                        <div class="my-4">
                            {!! Form::label('name_director2', 'ชื่อกรรมการคนที่ 2') !!}
                            {!! Form::select('name_director2',  array_merge([$datas_instructor[2]->name_Instructor,$name_Instructor]), ['class' => 'col-xl-8 col-lg-8 form-select']) !!}
                        </div>
                @endif
                @if (!empty($datas[0]->name_mentor))
                    <div class="my-4">
                        {!! Form::label('name_mentor', 'ชื่อที่ปรึกษาพิเศษ') !!}
                        {!! Form::text('name_mentor', $datas[0]->name_mentor, ['class' => 'form-control col-xl-5 col-lg-5']) !!}
                    </div>
                @endif
                {!! Form::submit('ยืนยัน', ['class' => 'btn btn-success']) !!}                     
            {!! Form::close() !!}
            @endif
            
            @if (Auth::user()->hasRole('Std'))
            {!! Form::open(['action' => ['projectControllers@edit_project',$datas[0]->id], 'method' => 'POST', 'enctype' =>
            'multipart/form-data']) !!}
            
                <div class="my-2">
                    {!! Form::label('name_th', 'ชื่อโปรเจค(ภาษาไทย)') !!}
                    {!! Form::text('Project_name_thai', $datas[0]->name_th, ['class' => 'form-control']) !!}
                </div>
                <div class="my-4">
                    {!! Form::label('name_eg', 'ชื่อโปรเจค(ภาษาอังกฤษ)') !!}
                    {!! Form::text('Project_name_eg', $datas[0]->name_en, ['class' => 'form-control']) !!}
                </div>
                @if (!empty($datas_std[0]->name))
                <div class="my-2 row">
                {!! Form::label('reg_std1', 'รหัสนักศึกษาคนที่ 1') !!}
                <div class="row">
                    <div class="col-xl-3 col-lg-3">
                        {!! Form::text('reg_std1', $datas_std[0]->std_code, ['class' => 'form-control ']) !!}
                    </div>
                   
                    <div id="name_reg1" class="col-xl-3 col-lg-3"></div>
                </div>
                </div>
                @endif

                @if (!empty($datas_std[1]->name))
                <div class="my-4">
                    {!! Form::label('reg_std2', 'รหัสนักศึกษาคนที่ 2') !!}
                    <div class="row">
                        <div class="col-xl-3 col-lg-3">
                            {!! Form::text('reg_std2', $datas_std[1]->std_code, ['class' => 'form-control']) !!}
                        </div>
                        <a href="{{ route('destroy_edit_name_project', $datas_std[1]->std_code) }}" class="btn btn-danger col-xl-1 col-lg-1">ลบรายชื่อ</a>
                        <div id="name_reg2" class="col-xl-3 col-lg-3"></div>
                    </div>
                </div>
                
                @else
                <div class="my-4">
                    {!! Form::label('reg_std2', 'รหัสนักศึกษาคนที่ 2') !!}
                    <div class="row">
                        <div class="col-xl-3 col-lg-3">
                            {!! Form::text('reg_std2',null, ['class' => 'form-control']) !!}
                        </div>
                        <div id="name_reg2" class="col-xl-3 col-lg-3"></div>
                    </div>
                </div>
                @endif
                @if (!empty($datas_std[2]->name))
                <div class="my-4">
                    {!! Form::label('reg_std3', 'รหัสนักศึกษาคนที่ 3') !!}
                    <div class="row">
                        <div class="col-xl-3 col-lg-3">
                            {!! Form::text('reg_std3', $datas_std[2]->std_code, ['class' => 'form-control']) !!}
                        </div>
                        <a href="{{ route('destroy_edit_name_project', $datas_std[2]->std_code) }}" class="btn btn-danger col-xl-1 col-lg-1">ลบรายชื่อ</a>
                        <div id="name_reg2" class="col-xl-3 col-lg-3"></div>>
                    </div>
                </div>
                @else
                <div class="my-4">
                    {!! Form::label('reg_std3', 'รหัสนักศึกษาคนที่ 3') !!}
                    <div class="row">
                        <div class="col-xl-3 col-lg-3">
                            {!! Form::text('reg_std3',null, ['class' => 'form-control']) !!}
                        </div>
                        <div id="name_reg3" class="col-xl-3 col-lg-3"></div>
                    </div>
                </div>
                @endif
                @if (!empty($datas_instructor[0]->name_Instructor) && $datas_instructor[0]->name_Instructor)
                    <div class="my-4">
                        {!! Form::label('name_president', 'ชื่อประธาน') !!}
                        {!! Form::select('name_president',  array_merge([$datas_instructor[0]->name_Instructor,$name_Instructor]), ['class' => ' col-8 form-select']) !!}
                    </div>
                @endif
                @if (!empty($datas_instructor[1]->name_Instructor))
                    <div class="my-4">
                        {!! Form::label('name_director1', 'ชื่อกรรมการคนที่ 1') !!}
                        {!! Form::select('name_director1',  array_merge([$datas_instructor[1]->name_Instructor,$name_Instructor]), ['class' => ' col-8 form-select']) !!}
                    </div>
                @endif
                @if (!empty($datas_instructor[2]->name_Instructor))
                    <div class="my-4">
                        <div class="my-4">
                            {!! Form::label('name_director2', 'ชื่อกรรมการคนที่ 2') !!}
                            {!! Form::select('name_director2',  array_merge([$datas_instructor[2]->name_Instructor,$name_Instructor]), ['class' => 'col-8 form-select']) !!}
                        </div>
                @endif
                @if (!empty($datas[0]->name_mentor))
                    <div class="my-4">
                        {!! Form::label('name_mentor', 'ชื่อที่ปรึกษาพิเศษ') !!}
                        {!! Form::text('name_mentor', $datas[0]->name_mentor, ['class' => 'form-control col-5']) !!}
                    </div>
                @endif
                <div class="my-4">
                    {!! Form::label('name_upload_File','นำไฟล์เข้า')!!}
                    {!! Form::file('File',["class"=>"form-control col-5"]) !!}
                 </div>
                 <div class="my-4">
                    {!! Form::label('because_reject','สาเหตุที่ไม่ผ่าน')!!}
                    {!! Form::text('because_reject', $datas[0]->because_reject,['readonly', "class"=>"form-control col-5"]) !!}
                 </div>
                {!! Form::submit('ยืนยัน', ['class' => 'btn btn-success']) !!}                     
            {!! Form::close() !!}
            @endif
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
