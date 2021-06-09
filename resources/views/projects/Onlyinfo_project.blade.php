@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <br />

        <div class="container">
            <h3 align="center">รายละเอียดโปรเจค</h3>
            <br />

            @if (Auth::user()->hasRole('Admin'))

                {{-- {{ $datas }} --}}
                {{-- {{ $datas_std[0]->year_term }} --}}
                {{-- {{ $datas_std[0]->name_file }} --}}
                {{-- {{ $datas_instructor }} --}}
                <div class="my-2">
                    {!! Form::label('name_th', 'ชื่อโปรเจค(ภาษาไทย)') !!}
                    {!! Form::text('Project_name_thai', $datas[0]->name_th, ['readonly', 'class' => 'form-control']) !!}
                </div>
                <div class="my-4">
                    {!! Form::label('name_eg', 'ชื่อโปรเจค(ภาษาอังกฤษ)') !!}
                    {!! Form::text('Project_name_eg', $datas[0]->name_en, ['readonly', 'class' => 'form-control']) !!}
                </div>
                <div class="my-2">
                    {!! Form::label('reg_std1', 'นักศึกษาคนที่ 1*(ตัวแทนกลุ่ม)') !!}
                    <a target="_blank" href="{{ route('std.showinfo', $datas_std[0]->id_reg_Std) }}">
                        {!! Form::text('reg_std1', $datas_std[0]->name, ['readonly', 'class' => 'form-control col-3']) !!}</a>
                </div>

                @if (!empty($datas_std[1]->name))
                    <div class="my-4">
                        {!! Form::label('reg_std2', 'นักศึกษาคนที่ 2') !!}
                        <a target="_blank" href="{{ route('std.showinfo', $datas_std[1]->id_reg_Std) }}">
                            {!! Form::text('reg_std2', $datas_std[1]->name, ['readonly', 'class' => 'form-control col-3']) !!}</a>
                @endif
                @if (!empty($datas_std[2]->name))
                    <div class="my-4">
                        {!! Form::label('reg_std3', 'นักศึกษาคนที่ 3') !!}
                        <a target="_blank" href="{{ route('std.showinfo', $datas_std[2]->id_reg_Std) }}">
                            {!! Form::text('reg_std3', $datas_std[2]->name, ['readonly', 'class' => 'form-control col-3']) !!}</a>
                    </div>
                @endif
                @if (!empty($datas_instructor[0]->name_Instructor) && $datas_instructor[0]->name_Instructor)
                    <div class="my-4">
                        {!! Form::label('name_president', 'ชื่อประธาน') !!}
                        {!! Form::text('name_president', $datas_instructor[0]->Title_name_Instructor . $datas_instructor[0]->name_Instructor, [
    'readonly',
    'class' => 'form-control
                        col-5',
]) !!}
                    </div>
                @endif
                @if (!empty($datas_instructor[1]->name_Instructor))
                    <div class="my-4">
                        {!! Form::label('name_director1', 'ชื่อกรรมการคนที่ 1') !!}
                        {!! Form::text('name_director1', $datas_instructor[1]->Title_name_Instructor . $datas_instructor[1]->name_Instructor, [
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
                            {!! Form::text('name_director2', $datas_instructor[2]->Title_name_Instructor . $datas_instructor[2]->name_Instructor, ['readonly', 'class' => 'form-control col-5']) !!}
                        </div>
                    </div>
                @endif
                @if (!empty($datas[0]->name_mentor))
                    <div class="my-4">
                        {!! Form::label('name_mentor', 'ชื่อที่ปรึกษาพิเศษ') !!}
                        {!! Form::text('name_mentor', $datas[0]->name_mentor, ['readonly', 'class' => 'form-control col-5']) !!}
                    </div>
                @endif
                <a href="{!! route('download', ['year' => $datas_std[0]->year, 'term' => $datas_std[0]->term, 'file' => $datas_std[0]->name_file]) !!}" download>ดาวน์โหลดเอกสาร นำเสนอโครงงาน</a>


                @if (!empty($test50))
                <div>
                    <a href="{!! route('InfoWordTemplate.download', ['form' => 'test50', 'status' => $test50->status_test50, 'file' => $test50->file_test50]) !!}" download>ดาวน์โหลดเอกสาร สอบ 50</a>
                </div>
                @endif


                @if (!empty($test100))
                <div>
                    <a href="{!! route('InfoWordTemplate.download', ['form' => 'test100', 'status' => $test100->status_test100, 'file' => $test100->file_test100]) !!}" download>ดาวน์โหลดเอกสาร สอบ 100</a>
                </div>
                @endif

            @endif
            @if (Auth::user()->hasRole('Std'))

                {{-- {{ $datas }} --}}
                {{-- {{ $datas_std[0]->year_term }} --}}
                {{-- {{ $datas_std[0]->name_file }} --}}
                {{-- {{ $datas_instructor }} --}}
                <div class="my-2">
                    {!! Form::label('name_th', 'ชื่อโปรเจค(ภาษาไทย)') !!}
                    {!! Form::text('Project_name_thai', $datas[0]->name_th, ['readonly', 'class' => 'form-control']) !!}
                </div>
                <div class="my-4">
                    {!! Form::label('name_eg', 'ชื่อโปรเจค(ภาษาอังกฤษ)') !!}
                    {!! Form::text('Project_name_eg', $datas[0]->name_en, ['readonly', 'class' => 'form-control']) !!}
                </div>
                <div class="my-2">
                    {!! Form::label('reg_std1', 'นักศึกษาคนที่ 1*(ตัวแทนกลุ่ม)') !!}
                    <a target="_blank" href="{{ route('std.showinfo', $datas_std[0]->id_reg_Std) }}">
                        {!! Form::text('reg_std1', $datas_std[0]->name, ['readonly', 'class' => 'form-control col-3']) !!}</a>
                </div>

                @if (!empty($datas_std[1]->name))
                    <div class="my-4">
                        {!! Form::label('reg_std2', 'นักศึกษาคนที่ 2') !!}
                        <a target="_blank" href="{{ route('std.showinfo', $datas_std[1]->id_reg_Std) }}">
                            {!! Form::text('reg_std2', $datas_std[1]->name, ['readonly', 'class' => 'form-control col-3']) !!}</a>
                @endif
                @if (!empty($datas_std[2]->name))
                    <div class="my-4">
                        {!! Form::label('reg_std3', 'นักศึกษาคนที่ 3') !!}
                        <a target="_blank" href="{{ route('std.showinfo', $datas_std[2]->id_reg_Std) }}">
                            {!! Form::text('reg_std3', $datas_std[2]->name, ['readonly', 'class' => 'form-control col-3']) !!}</a>
                    </div>
                @endif
                @if (!empty($datas_instructor[0]->name_Instructor) && $datas_instructor[0]->name_Instructor)
                    <div class="my-4">
                        {!! Form::label('name_president', 'ชื่อประธาน') !!}
                        {!! Form::text('name_president', $datas_instructor[0]->Title_name_Instructor . $datas_instructor[0]->name_Instructor, [
    'readonly',
    'class' => 'form-control
                    col-5',
]) !!}
                    </div>
                @endif
                @if (!empty($datas_instructor[1]->name_Instructor))
                    <div class="my-4">
                        {!! Form::label('name_director1', 'ชื่อกรรมการคนที่ 1') !!}
                        {!! Form::text('name_director1', $datas_instructor[1]->Title_name_Instructor . $datas_instructor[1]->name_Instructor, [
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
                            {!! Form::text('name_director2', $datas_instructor[2]->Title_name_Instructor . $datas_instructor[2]->name_Instructor, ['readonly', 'class' => 'form-control col-5']) !!}
                        </div>
                    </div>
                @endif
                @if (!empty($datas[0]->name_mentor))
                    <div class="my-4">
                        {!! Form::label('name_mentor', 'ชื่อที่ปรึกษาพิเศษ') !!}
                        {!! Form::text('name_mentor', $datas[0]->name_mentor, ['readonly', 'class' => 'form-control col-5']) !!}
                    </div>
                @endif
                {{-- <a href="{!!  route('download', ['year' => $datas_std[0]->year, 'term' => $datas_std[0]->term, 'file' => $datas_std[0]->name_file]) !!}"
                download>ดาวน์โหลดเอกสาร</a> --}}



            @endif
            @if (Auth::user()->hasRole('Tea'))

                {{-- {{ $datas }} --}}
                {{-- {{ $datas_std[0]->year_term }} --}}
                {{-- {{ $datas_std[0]->name_file }} --}}
                {{-- {{ $datas_instructor }} --}}
                <div class="my-2">
                    {!! Form::label('name_th', 'ชื่อโปรเจค(ภาษาไทย)') !!}
                    {!! Form::text('Project_name_thai', $datas[0]->name_th, ['readonly', 'class' => 'form-control']) !!}
                </div>
                <div class="my-4">
                    {!! Form::label('name_eg', 'ชื่อโปรเจค(ภาษาอังกฤษ)') !!}
                    {!! Form::text('Project_name_eg', $datas[0]->name_en, ['readonly', 'class' => 'form-control']) !!}
                </div>
                <div class="my-2">
                    {!! Form::label('reg_std1', 'นักศึกษาคนที่ 1*(ตัวแทนกลุ่ม)') !!}
                    <a target="_blank" href="{{ route('std.showinfo', $datas_std[0]->id_reg_Std) }}">
                        {!! Form::text('reg_std1', $datas_std[0]->name, ['readonly', 'class' => 'form-control col-3']) !!}</a>
                </div>

                @if (!empty($datas_std[1]->name))
                    <div class="my-4">
                        {!! Form::label('reg_std2', 'นักศึกษาคนที่ 2') !!}
                        <a target="_blank" href="{{ route('std.showinfo', $datas_std[1]->id_reg_Std) }}">
                            {!! Form::text('reg_std2', $datas_std[1]->name, ['readonly', 'class' => 'form-control col-3']) !!}</a>
                @endif
                @if (!empty($datas_std[2]->name))
                    <div class="my-4">
                        {!! Form::label('reg_std3', 'นักศึกษาคนที่ 3') !!}
                        <a target="_blank" href="{{ route('std.showinfo', $datas_std[2]->id_reg_Std) }}">
                            {!! Form::text('reg_std3', $datas_std[2]->name, ['readonly', 'class' => 'form-control col-3']) !!}</a>
                    </div>
                @endif
                @if (!empty($datas_instructor[0]->name_Instructor) && $datas_instructor[0]->name_Instructor)
                    <div class="my-4">
                        {!! Form::label('name_president', 'ชื่อประธาน') !!}
                        {!! Form::text('name_president', $datas_instructor[0]->Title_name_Instructor . $datas_instructor[0]->name_Instructor, [
    'readonly',
    'class' => 'form-control
                col-5',
]) !!}
                    </div>
                @endif
                @if (!empty($datas_instructor[1]->name_Instructor))
                    <div class="my-4">
                        {!! Form::label('name_director1', 'ชื่อกรรมการคนที่ 1') !!}
                        {!! Form::text('name_director1', $datas_instructor[1]->Title_name_Instructor . $datas_instructor[1]->name_Instructor, [
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
                            {!! Form::text('name_director2', $datas_instructor[2]->Title_name_Instructor . $datas_instructor[2]->name_Instructor, ['readonly', 'class' => 'form-control col-5']) !!}
                        </div>
                    </div>
                @endif
                @if (!empty($datas[0]->name_mentor))
                    <div class="my-4">
                        {!! Form::label('name_mentor', 'ชื่อที่ปรึกษาพิเศษ') !!}
                        {!! Form::text('name_mentor', $datas[0]->name_mentor, ['readonly', 'class' => 'form-control col-5']) !!}
                    </div>
                @endif
                <div>
                    <a href="{!! route('download', ['year' => $datas_std[0]->year, 'term' => $datas_std[0]->term, 'file' => $datas_std[0]->name_file]) !!}" download>ดาวน์โหลดเอกสาร นำเสนอโครงงาน</a>
                </div>
                @if (!empty($test50))
                <div>
                    <a href="{!! route('InfoWordTemplate.download', ['form' => 'test50', 'status' => $test50->status_test50, 'file' => $test50->file_test50]) !!}" download>ดาวน์โหลดเอกสาร สอบ 50</a>
                </div>
                @endif

                @if (!empty($report_50))
                <div>
                    <a href="{!! route('wordExport_ProgressReport_test_Download', ['test_form'=> 50 , 'id'=>$datas[0]->id]) !!}">รายงานการสอบความก้าวหน้า (สอบ50)</a>
                </div>
                @endif

                @if (!empty($test100))
                <div>
                    <a href="{!! route('InfoWordTemplate.download', ['form' => 'test100', 'status' => $test100->status_test100, 'file' => $test100->file_test100]) !!}" download>ดาวน์โหลดเอกสาร สอบ 100</a>
                </div>
                @endif

                @if (!empty($report_100))
                <div>
                    <a href="{!! route('wordExport_ProgressReport_test_Download', ['test_form'=> 100 , 'id'=>$datas[0]->id]) !!}">รายงานการสอบความก้าวหน้า (สอบ100)</a>
                </div>
                @endif
                @if (!empty($complete))
                <div>
                    <a href="{!! route('InfoWordTemplate.download', ['form' => 'CompleteForm', 'status' => $complete->status_CompleteForm, 'file' => $complete->file_CompleteForm]) !!}">รายงานการสอบความก้าวหน้า (สอบ100)</a>
                </div>
                @endif
                
            @endif
        </div>
    </body>

    </html>

@endsection
