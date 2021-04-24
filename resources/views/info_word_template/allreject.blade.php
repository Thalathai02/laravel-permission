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
                    {{-- {{$datas}} --}}

                    @foreach ($datas as $key => $rows)


                        <div class="card shadow mb-4">

                            <!-- Card Header - Dropdown -->
                            {{-- {{$data_project}} --}}
                            {{-- {{$row->test_id}} --}}
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                @if ($rows[0]->test_id == 1)
                                    <h6 class="m-0 font-weight-bold text-danger">คำแบบเสนอขอสอบ 50 ไม่ผ่าน</h6>
                                @elseif($rows[0]->test_id == 2)
                                    <h6 class="m-0 font-weight-bold text-danger">คำแบบเสนอขอสอบ 100 ไม่ผ่าน</h6>
                                @elseif($rows[0]->test_id == 3)
                                    <h6 class="m-0 font-weight-bold text-danger">
                                        ขออนุญาตเปลี่ยนแปลงหัวข้อโครงงานคอมพิวเตอร์ไม่ผ่าน</h6>
                                @elseif($rows[0]->test_id == 4)
                                    <h6 class="m-0 font-weight-bold text-danger">
                                        ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์ไม่ผ่าน</h6>
                                @elseif($rows[0]->test_id == 5)
                                    <h6 class="m-0 font-weight-bold text-danger">
                                        แบบขอส่งโครงงานฉบับสมบูรณ์ไม่ผ่าน</h6>
                                @endif
                            </div>

                            {{-- {{$data}} --}}
                            <!-- Card Body -->
                            @foreach ($rows as $key => $row)
                                <div class="card-body table-responsive">
                                    {{-- {{ $item }} --}}
                                    <div class="col-xl-3 col-md-6 ">
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div
                                                            class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                            {{ $row->name }}</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            {{ $row->comment_reject_tests }}</div>
                                                        <p>{{ $row->created_at }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>

                        <!-- Pie Chart -->

                    @endforeach
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>

    </body>

    </html>

@endsection
