@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <br />

        <div id="content">
            <!-- Begin Page Content -->

            <div class="container-fluid">
                <!-- Page Heading -->
                <!-- Content Row -->
                <!-- Content Row -->
                <div class="row">
                    <!-- Area Chart -->

                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        {{-- {{$data_project}} --}}
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            @if ($data_project[0]->test_id == 1)
                                <h6 class="m-0 font-weight-bold text-danger">คำแบบเสนอขอสอบ 50 ไม่ผ่าน</h6>
                            @elseif($data_project[0]->test_id == 2)
                                <h6 class="m-0 font-weight-bold text-danger">คำแบบเสนอขอสอบ 100 ไม่ผ่าน</h6>
                            @endif
                            @if ($notification == 0)
                                <div class="font-weight-bold text-warning text-uppercase m-0">
                                    รอการประเมิน...
                                </div>
                                @elseif($notification == 1)
                                <div class="font-weight-bold text-success text-uppercase m-0">
                                    สิ้นสุดประเมิน
                                </div>
                            @endif
                        </div>

                        {{-- {{$data}} --}}
                        <!-- Card Body -->
                        <div class="card-body table-responsive">
                            @foreach ($data_project as $key => $item)
                                {{-- {{ $item }} --}}
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-danger shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                        {{ $item->name }}</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        {{ $item->comment_reject_tests }}</div>
                                                    <p>{{ $item->created_at }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @if ($notification == 1)
                                <a href="{!! route('project.reject_allow', ['id' => $data_project[0]->project_id_reject_tests, 'id_test' => $data_project[0]->test_id]) !!}" class="btn btn-primary">รับทราบ</a>
                            @endif

                        </div>
                    </div>
                    <!-- Pie Chart -->
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>

    </body>

    </html>

@endsection
