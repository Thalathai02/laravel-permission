@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <div class="container">
            @if (Auth::user()->hasRole('Admin'))
                <div class="row">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $datas[0]->name_th }}</h6>
                            <h6 class="m-0 font-weight-bold text-primary">{{ $datas[0]->name_en }}</h6>
                        </div>
                        <div class="card-body">
                            <div>
                                <p class="m-0 font-weight-bold">อาจารย์ปรึกษา :</p>
                                @foreach ($datas_instructor as $data)
                                    <p>{{ $data->Title_name_Instructor }}{{ $data->name_Instructor }}</p>
                                @endforeach
                                @if(isset($data_project->name_mentor))
                                <p class="m-0 font-weight-bold">ที่ปรึกษาพิเศษ :</p>
                                <p>{{$data_project->name_mentor }}</p>
                                
                                @endif
                                <p class="m-0 font-weight-bold">ผู้จัดทำ :</p>
                                @foreach ($datas as $data)
                                    <p>{{ $data->name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::open(['action' => ['PublicProjectController@store', $data_project->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="row">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row my-2">
                                {!! Form::label('Number_project', 'เลขที่โครงงาน', ['class' => 'font-weight-bold']) !!}
                                {!! Form::text('Number_project', $data_project->number_project, ['class' => 'form-control col-12']) !!}
                            </div>
                            <div class="row my-2">
                                {!! Form::label('abstract_th', 'บทคัดย่อ', ['class' => 'font-weight-bold']) !!}
                                {!! Form::textarea('abstract_th', $data_project->abstract_th, ['class' => 'form-control col-12']) !!}
                            </div>
                            <div class="row my-2">
                                {!! Form::label('keyword_th', 'คำสำคัญ (กรุณาใส่ ";" เพื่อคั่นข้อความ)', ['class' => 'font-weight-bold']) !!}
                                {!! Form::text('keyword_th', $data_project->keyword_th, ['class' => 'form-control col-12']) !!}
                            </div>

                            <div class="row my-2">
                                {!! Form::label('abstract_eng', 'Abstract', ['class' => 'font-weight-bold']) !!}
                                {!! Form::textarea('abstract_eng', $data_project->abstract_eng, ['class' => 'form-control col-12']) !!}
                            </div>
                            <div class="row my-2">
                                {!! Form::label('keyword_eng', 'Keywords (กรุณาใส่ ";" เพื่อคั่นข้อความ)', ['class' => 'font-weight-bold']) !!}
                                {!! Form::text('keyword_eng', $data_project->keyword_eng, ['class' => 'form-control col-12']) !!}
                            </div>
                            <div class="row my-2">
                                {!! Form::label('Status_project', 'Status', ['class' => 'font-weight-bold']) !!}
                                {!! Form::select('Status', ['Private' => 'Private', 'Public' => 'Public'], $data_project->status, ['class' => 'form-select']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">อัปโหลดเอกสาร</h6>
                        </div>
                        <div class="card-body">
                            <div class="row my-2">
                                {!! Form::file('File', ['class' => 'form-control col-5']) !!}
                            </div>
                            <div class="row my-2">
                                {!! Form::label('Status_project_File', 'สถานะเอกสาร', ['class' => 'font-weight-bold']) !!}
                                {!! Form::select('Status_File', ['Private' => 'Private', 'Public' => 'Public'], $data_file->status_file_path, ['class' => 'form-select', 'placeholder' => 'select status...']) !!}
                            </div>
                            {{-- {{$data_file}} --}}
                        </div>
                    </div>
                </div>
                <div class=" row justify-content-md-center">
                    <div class="form-group col-xl-4 col-lg-4">
                        <input type="submit" value="บันทึก" class="my-2 form-control btn btn-primary " name="" id="">
                    </div>

                </div>
                {!! Form::close() !!}
            @endif
        </div>

    </body>

    </html>

@endsection
