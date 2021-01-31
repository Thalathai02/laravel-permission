@extends('layouts.app')
@section('content')
    @if (Auth::user()->hasRole('Std'))
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-12 col-lg-7 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                {{$data_topics_Dashboard}}
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$data_progress_Dashboard}}</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: {{$data_progress_Dashboard}}" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-7 col-lg-7">
                            <div class="card shadow mb-2">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">ข้อมูลโปรเจด</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body ">
                                    @if (!empty($datas))
                                    <div class="my-2">
                                        {!! Form::label('name_th', 'ชื่อโปรเจค(ภาษาไทย)') !!}
                                        {!! Form::text('Project_name_thai', $datas[0]->name_th, ['readonly', 'class' => 'form-control']) !!}
                                    </div>
                                    <div class="my-4">
                                        {!! Form::label('name_eg', 'ชื่อโปรเจค(ภาษาอังกฤษ)') !!}
                                        {!! Form::text('Project_name_eg', $datas[0]->name_en, ['readonly', 'class' => 'form-control']) !!}
                                    </div>
                                    @endif
                                    @if (!empty($datas_instructor[0]->name_Instructor) && $datas_instructor[0]->name_Instructor)
                                        <div class="my-4">
                                            {!! Form::label('name_president', 'ชื่อประธาน') !!}
                                            {!! Form::text('name_president',$datas_instructor[0]->Title_name_Instructor.$datas_instructor[0]->name_Instructor, [
                                            'readonly',
                                            'class' => 'form-control
                                            ',
                                            ]) !!}
                                        </div>
                                    @endif
                                    @if (!empty($datas_instructor[1]->name_Instructor))
                                        <div class="my-4">
                                            {!! Form::label('name_director1', 'ชื่อกรรมการคนที่ 1') !!}
                                            {!! Form::text('name_director1',$datas_instructor[1]->Title_name_Instructor.$datas_instructor[1]->name_Instructor, [
                                            'readonly',
                                            'class' => 'form-control
                                            ',
                                            ]) !!}
                                        </div>
                                    @endif
                                    @if (!empty($datas_instructor[2]->name_Instructor))
                                        <div class="my-4">
                                            <div class="my-4">
                                                {!! Form::label('name_director2', 'ชื่อกรรมการคนที่ 2') !!}
                                                {!! Form::text('name_director2', $datas_instructor[2]->Title_name_Instructor.$datas_instructor[2]->name_Instructor, ['readonly', 'class' =>
                                                'form-control ']) !!}
                                            </div>
                                        </div>
                                    @endif
                                    @if (!empty($datas[0]->name_mentor))
                                        <div class="my-4">
                                            {!! Form::label('name_mentor', 'ชื่อที่ปรึกษาพิเศษ') !!}
                                            {!! Form::text('name_mentor', $datas[0]->name_mentor, ['readonly', 'class' => 'form-control '])
                                            !!}
                                        </div>
                                    @endif



                                </div>
                            </div>
                        </div>
                        <!-- Pie Chart -->
                        <div class="col-xl-5 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">ความคืบหน้าของเอกสาร</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div
                                                class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                แบบเสนอขอสอบ50</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 text-red">
                                                รอการตรวจสอบ/ผ่าน/ไม่ผ่าน</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div
                                                class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                รายงานการสอบความก้าวหน้า(สอบ 50)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 text-red">
                                                รอการตรวจสอบ/ผ่าน/ไม่ผ่าน</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    @endif
@endsection
