@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <div class="container">
            <h3 align="center" class="my-4">ระบบจัดการโครงงานคอมพิวเตอร์</h3>
            @if (Auth::user()->hasRole('Admin'))
                <div class="form-group">
                    {!! Form::open(['action' => 'PublicProjectController@search_public_projec', 'method' => 'POST']) !!}
                    <div class="row ">
                        {{ csrf_field() }}
                        <div class="col-1">
                            {!! Form::label('search', 'ค้นหา') !!}
                        </div>
                        <div class="col-4">
                            {!! Form::text('search', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-2">
                            <input type="submit" value="ค้นหา" class="btn btn-primary" name="submit_1" id="">
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                @if (isset($project))

                    @foreach ($project as $key => $row)
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">{{ $row->name_th }}</h6>
                                <h6 class="m-0 font-weight-bold text-primary">{{ $row->name_en }}</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                            src="img/undraw_posting_photo.svg" alt="">
                                    </div>
                                    <div class="col">
                                        <p>{{ \Illuminate\Support\Str::limit($row->abstract_th, $limit = 200, $end = '...') }}
                                        </p>
                                        <p><strong>รหัสโครงงาน : </strong>{{ $row->number_project }}</p>
                                        <p><strong> สถานะ : </strong>{{ $row->status }}</p>
                                        <p><strong>คำสำคัญ : </strong>{{ $row->keyword_th }}</p>
                                        <p><strong>Keywords : </strong>{{ $row->keyword_eng }}</p>
                                        <a target="_blank" rel="nofollow"
                                            href="{{ route('PublicProject.edit_public_projec', $row->id) }}">แก้ไข
                                            &rarr;</a> <br>
                                        <a target="_blank" rel="nofollow"
                                            href="{{ route('PublicProject.view_public_projec', $row->id) }}">ดูเอกสาร
                                            &rarr;</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                @else
                    <p>There are no data.</p>
                @endif

            @endif
        </div>

    </body>

    </html>

@endsection
