@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <br />

        <div class="container">
            <h3 align="center">ประเมินการสอบ 50</h3>
            {!! Form::open(['action' => ['projectControllers@comment_test50_Datas',$datas[0]->id], 'method' => 'POST']) !!}
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
            <div class="my4">
                {!! Form::label('date_test50', 'จะขอสอบ 50 % ในวันที่ ') !!}
                {!! Form::text('date_test50', formatDateThai($tableTest50_id->date_test50), ['readonly', 'class' =>
                'form-control col-5']) !!}

            </div>
            <div class="my4">
                {!! Form::label('date_test50', 'เวลา ') !!}
                {!! Form::text('date_test50_time', formatDateThai_time($tableTest50_id->date_test50), ['readonly', 'class'
                => 'form-control col-5']) !!}

            </div>

            <div class="my-4">
                {!! Form::label('room_test50', 'ห้องสอบ ') !!}
                {!! Form::text('room_test50', $tableTest50_id->room_test50, ['readonly', 'class' => 'form-control col-5'])
                !!}
            </div>
            <div class="my-4">
                {!! Form::label('selecttopic', 'กรุณาเลือก ') !!}
                {!! Form::select('selecttopic', [ '1' => 'ผ่าน', '2' => 'ไม่ผ่าน'], '0', ['class' =>
                'form-select col-5']) !!}


            </div>
            <div class="my-4">
                {!! Form::label('commemt', 'ความคิดเห็น') !!}
                {!! Form::textarea('commemt', '', ['class' => 'form-control col-8']) !!}
            </div>

            <div class="my-2">
                <a class="btn btn-success btn-icon-split" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text">ยืนยัน</span>
                </a>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{-- <p>หากเลือกบันทึกข้อมูล จะสามารถกลับมาแก้ไขประเมินได้</p> --}}
                            <p>ถ้าเลือก ผ่าน/ไม่ผ่าน จะไม่สามารถแก้ไขได้</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>

    </body>

    </html>

@endsection
