@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <br />

        <div class="container">
            <h3 align="center">ใบคำร้อง แบบเสนอขอสอบ50</h3>
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
            {!! Form::open(['action' => ['projectControllers@wordExport_test50',$datas[0]->id], 'method' => 'POST', 'enctype' =>
            'multipart/form-data']) !!}

            <div class="my-2">
                {!! Form::label('name_th', 'ชื่อโปรเจค(ภาษาไทย)') !!}
                {!! Form::text('Project_name_thai', $datas[0]->name_th, ['readonly', 'class' => 'form-control']) !!}
            </div>
            <div class="my-4">
                {!! Form::label('name_eg', 'ชื่อโปรเจค(ภาษาอังกฤษ)') !!}
                {!! Form::text('Project_name_eg', $datas[0]->name_en, ['readonly', 'class' => 'form-control']) !!}
            </div>
            <div class="my-2 row-1">
                {!! Form::label('reg_std1', 'รหัสนักศึกษาคนที่ 1') !!}
                <div class="row">
                    {!! Form::text('reg_std1', $datas_std[0]->std_code, ['readonly', 'class' => 'form-control col-3']) !!}
                    {!! Form::text('reg_std1_name', $datas_std[0]->name, ['readonly', 'class' => 'form-control col-3']) !!}
                    {!! Form::text('reg_std1_Phone', $datas_std[0]->phone, ['readonly', 'class' => 'form-control col-3'])
                    !!}
                </div>
            </div>


            @if (!empty($datas_std[1]->name))
                <div class="my-4">
                    {!! Form::label('reg_std2', 'รหัสนักศึกษาคนที่ 2') !!}
                    <div class="row">
                        {!! Form::text('reg_std2', $datas_std[1]->std_code, ['readonly', 'class' => 'form-control col-3'])
                        !!}
                        {!! Form::text('reg_std2_name', $datas_std[1]->name, ['readonly', 'class' => 'form-control col-3'])
                        !!}
                        {!! Form::text('reg_std2_Phone', $datas_std[1]->phone, [
                        'readonly',
                        'class' => 'form-control
                        col-3',
                        ]) !!}
                    </div>
                </div>

            @endif
            @if (!empty($datas_std[2]->name))
                <div class="my-4">
                    {!! Form::label('reg_std3', 'รหัสนักศึกษาคนที่ 3') !!}
                    <div class="row">
                        {!! Form::text('reg_std3', $datas_std[2]->std_code, ['readonly', 'class' => 'form-control col-3'])
                        !!}
                        {!! Form::text('reg_std3_name', $datas_std[2]->name, ['readonly', 'class' => 'form-control col-3'])
                        !!}
                        {!! Form::text('reg_std3_Phone', $datas_std[2]->phone, [
                        'readonly',
                        'class' => 'form-control
                        col-3',
                        ]) !!}
                    </div>
                </div>
            @endif
            @if (!empty($datas_instructor[0]->name_Instructor) && $datas_instructor[0]->name_Instructor)
                <div class="my-4">
                    {!! Form::label('name_president', 'ชื่อประธาน') !!}
                    {!! Form::text('name_president', $datas_instructor[0]->Title_name_Instructor .
                    $datas_instructor[0]->name_Instructor, [
                    'readonly',
                    'class' => 'form-control
                    col-5',
                    ]) !!}
                </div>
            @endif
            @if (!empty($datas_instructor[1]->name_Instructor))
                <div class="my-4">
                    {!! Form::label('name_director1', 'ชื่อกรรมการคนที่ 1') !!}
                    {!! Form::text('name_director1', $datas_instructor[1]->Title_name_Instructor .
                    $datas_instructor[1]->name_Instructor, [
                    'readonly',
                    'class' => 'form-control
                    col-5',
                    ]) !!}
                </div>
            @endif
            @if (!empty($datas_instructor[2]->name_Instructor))
                <div class="my-4">
                    <div class="my-4">
                        {!! Form::label('name_director2', 'ชื่อกรรมการคนที่ 2') !!}
                        {!! Form::text('name_director2', $datas_instructor[2]->Title_name_Instructor .
                        $datas_instructor[2]->name_Instructor, ['readonly', 'class' => 'form-control col-5']) !!}
                    </div>
            @endif
            @if (!empty($datas[0]->name_mentor))
                <div class="my-4">
                    {!! Form::label('name_mentor', 'ชื่อที่ปรึกษาพิเศษ') !!}
                    {!! Form::text('name_mentor', $datas[0]->name_mentor, ['readonly', 'class' => 'form-control col-5']) !!}
                </div>
            @endif

            <div class="my4">
                {!! Form::label('date_test50', 'จะขอสอบ 50 % ในวันที่ ') !!}
                {!! Form::datetimeLocal('date_test50', \Carbon\Carbon::now(), ['class' => 'form-control col-5']) !!}

            </div>



            <div class="my-4">
                {!! Form::label('room_test50', 'ห้องสอบ ') !!}
                {!! Form::text('room_test50', null, ['class' => 'form-control col-5']) !!}
            </div>
            <div class="my-4">
                {!! Form::label('name_upload_File', 'นำไฟล์เข้า') !!}
                {!! Form::file('File', ['class' => 'form-control col-5']) !!}
            </div>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                ดาวน์โหลดเอกสาร
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">คำเตือน</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            กรุณาเช็คแบบฟอร์มก่อนสั่งพิมพ์
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ออก</button>
                            {!! Form::submit('ยืนยัน', ['class' => 'btn btn-danger']) !!}
                        </div>
                    </div>
                </div>
            </div>



            {!! Form::close() !!}
        </div>
        <script type="text/javascript">
            $('#datetimepicker').datetimepicker({
                format: 'dd/mm/yyyy'
            });

        </script>
    </body>

    </html>

@endsection
