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
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">ผลประเมินการสอบ</h6>
                            @if ($keys == 2)
                                @if ($sumbit == 3)
                                    <div class="font-weight-bold text-success text-uppercase m-0">
                                        ผ่าน
                                        <span class="icon">
                                            <i class="fas fa-check"></i>
                                        </span>
                                    </div>
                                @elseif($sumbit > 3)
                                <div class="font-weight-bold text-danger text-uppercase m-0">
                                    ไม่ผ่าน
                                    <span class="icon">
                                        <i class="fas fa-times"></i>
                                    </span>
                                </div>
                                @endif
                                @else
                                <div class="font-weight-bold text-warning text-uppercase m-0">
                                    รอการประเมิน...
                                </div>
                                @endif

                                
                        </div>
                        {{-- {{$data}} --}}
                        <!-- Card Body -->
                        <div class="card-body table-responsive">
                            <br>
                            @foreach ($data as $key => $value)

                                @if ($value->Is_president == 1)
                                    @if ($value->action_comemt_test100 == 1)
                                        <div class="col-xl col-md mb">
                                            <div class="card border-left-success shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div
                                                                class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                                ประธาน
                                                                <span class="icon">
                                                                    <i class="fas fa-check"></i>
                                                                </span>
                                                            </div>
                                                            <div class="h5 mb-0 font-text-truncate text-gray-800">
                                                                {{ $value->text_comemt_test100 }}</div>
                                                            <div>
                                                                {{ $value->Title_name_Instructor . $value->name_Instructor }}
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    @else
                                        <div class="col-xl col-md mb">
                                            <div class="card border-left-danger shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div
                                                                class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                                ประธาน
                                                                <span class="icon">
                                                                    <i class="fas fa-times"></i>
                                                                </span>
                                                            </div>
                                                            <div class="h5 mb-0 font-weight text-gray-800">
                                                                {{ $value->text_comemt_test100 }}</div>
                                                            <div>
                                                                {{ $value->Title_name_Instructor . $value->name_Instructor }}
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    @endif
                                @elseif($value->Is_president == 0)
                                    @if ($value->action_comemt_test100 == 1)
                                        <div class="col-xl col-md mb">
                                            <div class="card border-left-success shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div
                                                                class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                                กรรมการ
                                                                <span class="icon">
                                                                    <i class="fas fa-check"></i>
                                                                </span>
                                                            </div>
                                                            <div class="h5 mb-0 font-text-truncate text-gray-800">
                                                                {{ $value->text_comemt_test100 }}</div>
                                                            <div>
                                                                {{ $value->Title_name_Instructor . $value->name_Instructor }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    @else
                                        <div class="col-xl col-md mb">
                                            <div class="card border-left-danger shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div
                                                                class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                                กรรมการ
                                                                <span class="icon">
                                                                    <i class="fas fa-times"></i>
                                                                </span>
                                                            </div>
                                                            <div class="h5 mb-0 font-weight text-gray-800">
                                                                {{ $value->text_comemt_test100 }}</div>
                                                            <div>
                                                                {{ $value->Title_name_Instructor . $value->name_Instructor }}
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        @if ($key == 2)
                        @if($sumbit > 3)
                            {{-- <div class="my-2">
                                                       
                                <a href="{!! route('remove_comment_test100', ['id1' => $data[0]->id,'id2' => $data[1]->id,'id3' => $data[2]->id] ) !!}" class="btn btn-success btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <span class="text">รับทราบ</span>
                                </a>
                            </div> --}}
                        @else
                        @endif
                        @else
                        @endif

                    </div>
                    <!-- Pie Chart -->
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>

    </body>

    </html>

@endsection
