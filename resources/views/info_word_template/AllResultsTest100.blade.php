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
                            <h6 class="m-0 font-weight-bold text-primary">รวมผลประเมินการสอบ</h6>
                        </div>
                        {{-- {{$data}} --}}
                        <!-- Card Body -->
                        <div class="card-body table-responsive">
                            <br>
                            @foreach ($data as $key => $value)

                                @if ($value->Is_president == 1)
                                @if($value->action_comemt_test100==1)
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
                                                        <div>{{ $value->Title_name_Instructor.$value->name_Instructor }}</div>

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
                                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                            ประธาน
                                                            <span class="icon">
                                                                <i class="fas fa-times"></i>
                                                            </span>
                                                        </div>
                                                        <div class="h5 mb-0 font-weight text-gray-800">
                                                            {{ $value->text_comemt_test100 }}</div>
                                                            <div>{{ $value->Title_name_Instructor.$value->name_Instructor }}</div>
                                                    </div>
        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    @endif
                                @elseif($value->Is_president == 0)
                                @if($value->action_comemt_test100==1)
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
                                                        <div>{{ $value->Title_name_Instructor.$value->name_Instructor }}</div>
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
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                        กรรมการ
                                                        <span class="icon">
                                                            <i class="fas fa-times"></i>
                                                        </span>
                                                    </div>
                                                    <div class="h5 mb-0 font-weight text-gray-800">
                                                        {{ $value->text_comemt_test100 }}</div>
                                                        <div>{{ $value->Title_name_Instructor.$value->name_Instructor }}</div>
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

                    </div>
                    <!-- Pie Chart -->

                </div>
            </div>
            <!-- /.container-fluid -->
        </div>

    </body>

    </html>

@endsection
