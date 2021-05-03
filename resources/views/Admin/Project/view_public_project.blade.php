@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <div class="container">
            
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

                                @if($data->Is_president==1)
                                <p>{{ $data->Title_name_Instructor }}{{ $data->name_Instructor }} (ประธาน)</p>
                                @else
                                <p>{{ $data->Title_name_Instructor }}{{ $data->name_Instructor }} (กรรมการ)</p>
                                @endif
                                   
                                @endforeach

                                <p class="m-0 font-weight-bold">ผู้จัดทำ :</p>
                                @foreach ($datas as $data)
                                    <p>{{ $data->name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row my-2">
                                <span>
                                    <strong class="m-0 font-weight-bold">เลขที่โครงงาน : </strong>
                                    <span class="font-weight">{{ $data_project->number_project }}</span>
                                </span>
                            </div>
                            <div class="row my-2">
                                {!! Form::label('abstract_th', 'บทคัดย่อ', ['class' => 'font-weight-bold']) !!}
                                <span class="font-weight">{{$data_project->abstract_th}}</span>
                            </div>
                            <div class="row my-2">
                                {!! Form::label('keyword_th', 'คำสำคัญ', ['class' => 'font-weight-bold']) !!}
                                <span class="font-weight"> {{$data_project->keyword_th}}</span>
                            </div>

                            <div class="row my-2">
                                {!! Form::label('abstract_eng', 'Abstract', ['class' => 'font-weight-bold']) !!}
                                <span class="font-weight"> {{$data_project->abstract_eng}}</span>
                            </div>
                            <div class="row my-2">
                                {!! Form::label('keyword_eng', 'Keywords', ['class' => 'font-weight-bold']) !!}
                                <span class="font-weight"> {{ $data_project->keyword_eng}}</span>
                            </div>
                            <div class="row my-2">
                                {!! Form::label('Status_project', 'สถานะ', ['class' => 'font-weight-bold']) !!}
                                <span class="font-weight"> {{ $data_project->status}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">ดาวน์โหลดเอกสาร</h6>
                        </div>
                        @if(isset($data_file))
                        <div class="card-body">
                            <div class="row mb-2">
                                {!! Form::label('Status_project_File', 'สถานะเอกสาร', ['class' => 'font-weight-bold']) !!}
                                <span class="font-weight">{{$data_file->status_file_path }}</span>
                            </div>
                            <div class="row my-2">
                                <a href="{!! route('PublicProject.download', ['form' => 'Successfully', 'file' => $data_file->name_file]) !!}" download>ดาวน์โหลดเอกสาร</a>
                            </div>
                        </div>
                        @else
                        <div class="card-body">
                            <div class="row mb-2">
                                {!! Form::label('Status_project_File', 'สถานะเอกสาร', ['class' => 'font-weight-bold']) !!}
                                <span class="font-weight">Private</span>
                            </div>
                            
                        </div>
                        @endif
                        
                    </div>
                </div>               
                {{-- {{$data_file}} --}}
         
        </div>

    </body>

    </html>

@endsection
