@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <br />

        <div class="container">
            <h3 align="center">โปรเจดที่เป็นกรรมการ</h3>
            <br />
            @if (isset($datas))
                <h5>โครงงานที่ยังไม่เสร็จ</h5>
                <div class="mb-4">
                    @foreach ($datas as $row)
                        @if ($row->status == 'Check')

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-info">{{ $row->name_th }}</h6>
                                    <h6 class="m-0 font-weight-bold text-info">{{ $row->name_en }}</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class=" col-xl-3 col-lg-3">
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
                                                href="{{ route('Check_Project.show', $row->id) }}">ดูเอกสาร
                                                &rarr;</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    {!! $datas->links() !!}

                </div>
            @endif
            @if (isset($data_project_public))
                <h5>โครงงานฉบับสมบูรณ์</h5>
                <div class="mb-4">
                    @foreach ($data_project_public as $row)
                        @if ($row->status !== 'Check')
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{ $row->name_th }}</h6>
                                    <h6 class="m-0 font-weight-bold text-primary">{{ $row->name_en }}</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class=" col-xl-3 col-lg-3">
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
                                                href="{{ route('PublicProject.view_public_projec', $row->id) }}">ดูเอกสาร
                                                &rarr;</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    {!! $datas->links() !!}
                </div>
            @endif

        </div>
        <script>
            $(document).ready(function() {
                $("#staticBackdrop").modal('show');
            });

        </script>


    </body>

    </html>

@endsection
