@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <br />

        <div class="container">
            <h3 align="center">ขออนุญาตเปลี่ยนแปลงหัวข้อโครงงานคอมพิวเตอร์</h3>
            <br />

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
            <h3 class="my-4">จากเดิม</h3>
            <div class="my-2">
                {!! Form::label('name_th', 'ชื่อโปรเจค(ภาษาไทย)') !!}
                {!! Form::text('Project_name_thai', $datas[0]->name_th, ['readonly', 'class' => 'form-control']) !!}
            </div>
            <div class="my-4">
                {!! Form::label('name_eg', 'ชื่อโปรเจค(ภาษาอังกฤษ)') !!}
                {!! Form::text('Project_name_eg', $datas[0]->name_en, ['readonly', 'class' => 'form-control']) !!}
            </div>
            <h3 class="my-4">เป็น </h3>
            <div class="my-2">
                {!! Form::label('name_th', 'ชื่อโปรเจค(ภาษาไทย)') !!}
                {!! Form::text('new_project_name_thai', $tablechangetopic_id->new_name_th, ['readonly','class' => 'form-control']) !!}
            </div>
            <div class="my-4">
                {!! Form::label('name_eg', 'ชื่อโปรเจค(ภาษาอังกฤษ)') !!}
                {!! Form::text('new_project_name_eg', $tablechangetopic_id->new_name_en, [ 'readonly','class' => 'form-control']) !!}
            </div>
        <div class="my-4">
            {!! Form::label('note', 'เนื่องจาก') !!}
            {!! Form::textarea('note',$tablechangetopic_id->note, ['readonly','class' => 'form-control col-8']) !!}
        </div>
           

        </div>
        <div class="my-2">
            <a href="{!!  route('InfoWordTemplate.markAsRead', ['id'=>$id_Notifications]) !!}" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">เอกสารผ่าน</span>
            </a>
            
            <a data-toggle="modal" data-target="#exampleModal" class="btn btn-danger btn-icon-split my-2">
                <span class="icon text-white-50">
                    <i class="fas fa-times"></i>
                </span>
                <span class="text">เอกสารไม่ผ่าน</span>
            </a>

            {!! Form::open(['action' => ['projectControllers@reject_project',$id_Notifications,$datas[0]->id,3], 'method' => 'POST']) !!}
            <!-- Modal -->
            <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">คุณต้องการให้โครงการ
                                ไม่ผ่านหรือไม่ ?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                {!! Form::label('reject', 'สาเหตุที่ไม่ผ่าน') !!}
                                {!! Form::text('reject', null, ['class' => 'form-control']) !!}
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-danger">ยืนยัน</button>

                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
            @if (Auth::user()->hasRole('Admin'))
            <a href="{{ route('project.edit',  $datas[0]->id) }}" class="btn btn-info btn-icon-split" target="_blank">
                <span class="icon text-white-50">
                    <i class="fas fa-info-circle"></i>
                </span>
                <span class="text">แก้ไขโปรเจด</span>
            </a>
            
           
            @endif
        </div>
        
    </div>
    </body>

    </html>

@endsection
