<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>

<body>
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
                            @if ($data_topics_Dashboard == 'ยังไม่ส่งหัวข้อ')
                                <div>
                                    <a href="/projects/into_project" class="btn btn-primary my-2"
                                        align="left">ส่งหัวข้อโครงงาน</a>
                                </div>
                            @elseif($data_topics_Dashboard == 'แต่งตั้งประธานและกรรมการแล้ว' || $data_topics_Dashboard
                                == 'ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์' || $data_topics_Dashboard ==
                                'ขออนุญาตเปลี่ยนแปลงหัวข้อโครงงานคอมพิวเตอร์' )
                                <div>
                                    <a class="btn btn-primary my-1"
                                        href="{{ route('project.test50', Auth::user()->id) }}">แบบเสนอขอสอบ50</a>

                                    <a class="btn btn-primary my-1"
                                        href="{{ route('project.ChangeBoard', Auth::user()->id) }}">ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์</a>

                                    <a class="btn btn-primary my-1"
                                        href="{{ route('project.ChangeTopic', Auth::user()->id) }}">ขออนุญาตเปลี่ยนแปลงหัวข้อโครงงานคอมพิวเตอร์</a>
                                </div>
                            @elseif($data_topics_Dashboard == 'เสนอขอสอบ50')
                                <div>
                                    @if ($check_report == 1)
                                        <a class="btn btn-primary my-2"
                                            href="{{ route('project.ProgressReport_test50', Auth::user()->id) }}">รายงานการสอบความก้าวหน้า
                                            (สอบ50)</a>
                                    @endif


                                </div>

                            @elseif($data_topics_Dashboard == 'รายงานการสอบความก้าวหน้า (สอบ50)')

                                <div>
                                    <a class="btn btn-primary my-2"
                                        href="{{ route('project.test100', Auth::user()->id) }}">แบบเสนอขอสอบ100</a>
                                </div>
                            @elseif($data_topics_Dashboard == 'เสนอขอสอบ100')
                                <div>
                                    @if ($check_report == 1)
                                        <a class="btn btn-primary my-2"
                                            href="{{ route('project.ProgressReport_test100', Auth::user()->id) }}">รายงานการสอบความก้าวหน้า
                                            (สอบ100)</a>
                                    @endif


                                </div>
                            @elseif($data_topics_Dashboard == 'รายงานการสอบความก้าวหน้า (สอบ100)')
                                <div>
                                    <a class="btn btn-primary my-2"
                                        href="{{ route('project.CompleteForm', Auth::user()->id) }}">แบบขอส่งโครงงานฉบับสมบูรณ์</a>
                                </div>
                            @else
                            @endif
                            <div class="col-xl-12 col-lg-7 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    {{ $data_topics_Dashboard }}
                                                </div>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                            {{ $data_progress_Dashboard . '%' }}</div>
                                                    </div>
                                                    <div class="col">


                                                        <div class="container-fluid">
                                                            <ul class="progressbar">
                                                                <div>
                                                                    <li @if ($data_topics_Dashboard == 'ยังไม่ส่งหัวข้อ') class="active" @endif>ยังไม่ส่งหัวข้อ</li>
                                                                </div>
                                                                <div>
                                                                    <li @if ($data_topics_Dashboard == 'ส่งหัวข้อแล้ว รอแต่งตั้งประท่านกรรมการ') class="active" @endif>ส่งหัวข้อแล้ว รอแต่งตั้งประท่านกรรมการ</li>
                                                                </div>
                                                                <div>
                                                                    <li @if ($data_topics_Dashboard == 'แต่งตั้งประธานและกรรมการแล้ว' || $data_topics_Dashboard == 'ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์' || $data_topics_Dashboard == 'ขออนุญาตเปลี่ยนแปลงหัวข้อโครงงานคอมพิวเตอร์') class="active" @endif>แต่งตั้งประธานและกรรมการแล้ว</li>
                                                                </div>
                                                                <div>
                                                                    <li @if ($data_topics_Dashboard == 'เสนอขอสอบ50') class="active" @endif>เสนอขอสอบ50</li>
                                                                </div>
                                                                <div>
                                                                    <li @if ($data_topics_Dashboard == 'รายงานการสอบความก้าวหน้า (สอบ50)') class="active" @endif>รายงานการสอบความก้าวหน้า (สอบ50)</li>
                                                                </div>
                                                                <div>
                                                                    <li @if ($data_topics_Dashboard == 'เสนอขอสอบ100') class="active" @endif>เสนอขอสอบ100</li>
                                                                </div>
                                                                <div>
                                                                    <li @if ($data_topics_Dashboard == 'รายงานการสอบความก้าวหน้า (สอบ100)') class="active" @endif>รายงานการสอบความก้าวหน้า (สอบ100)</li>
                                                                </div>

                                                                <div>
                                                                    <li @if ($data_topics_Dashboard == 'แบบขอส่งโครงงานฉบับสมบูรณ์') class="active" @endif>แบบขอส่งโครงงานฉบับสมบูรณ์</li>
                                                                </div>
                                                            </ul>
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
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
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
                                                <a target="_blank"
                                                    href="{{ route('Teacher.info_tea', $datas_instructor[0]->id) }}">{!! Form::text('name_president', $datas_instructor[0]->Title_name_Instructor . $datas_instructor[0]->name_Instructor, ['readonly', 'class' => 'form-control']) !!}
                                                </a>
                                            </div>
                                        @endif
                                        @if (!empty($datas_instructor[1]->name_Instructor))
                                            <div class="my-4">
                                                {!! Form::label('name_director1', 'ชื่อกรรมการคนที่ 1') !!}
                                                <a target="_blank"
                                                    href="{{ route('Teacher.info_tea', $datas_instructor[1]->id) }}">{!! Form::text('name_director1', $datas_instructor[1]->Title_name_Instructor . $datas_instructor[1]->name_Instructor, ['readonly', 'class' => 'form-control']) !!}</a>
                                            </div>
                                        @endif
                                        @if (!empty($datas_instructor[2]->name_Instructor))
                                            <div class="my-4">
                                                <div class="my-4">
                                                    {!! Form::label('name_director2', 'ชื่อกรรมการคนที่ 2') !!}
                                                    <a target="_blank"
                                                        href="{{ route('Teacher.info_tea', $datas_instructor[2]->id) }}">{!! Form::text('name_director2', $datas_instructor[2]->Title_name_Instructor . $datas_instructor[2]->name_Instructor, ['readonly', 'class' => 'form-control ']) !!}</a>
                                                </div>
                                            </div>
                                        @endif
                                        @if (!empty($datas[0]->name_mentor))
                                            <div class="my-4">
                                                {!! Form::label('name_mentor', 'ชื่อที่ปรึกษาพิเศษ') !!}
                                                {!! Form::text('name_mentor', $datas[0]->name_mentor, ['readonly', 'class' => 'form-control ']) !!}
                                            </div>
                                        @endif



                                    </div>
                                </div>
                            </div>
                            <!-- Pie Chart -->
                            <div class="col-xl-5 col-lg-5">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h5 class="m-0 font-weight-bold text-primary">ความคืบหน้าของเอกสาร</h5>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-2"
                                                    style="font-size:18px">
                                                    {{ $data_topics_Dashboard }}</div>
                                                @isset($notification)
                                                    @foreach ($notification as $key => $item)
                                                        <p>
                                                            @if ($item[0] == 0)
                                                                <span style="font-size: 48px; color: Tomato;">
                                                                    <i class="fas fa-user"></i>
                                                                </span> {{ $item[1]['name'] }}
                                                            @elseif ($item[0] == 1)
                                                                <span style="font-size: 48px; color: Dodgerblue;">
                                                                    <i class="fas fa-user"></i>
                                                                </span>
                                                                {{ $item[1]['name'] }}
                                                                {{-- {{ $item[0] }} --}}
                                                            @endif

                                                        </p>
                                                    @endforeach
                                                @endisset
                                                @isset($notification_id)
                                                    @if ($notification_id == 0)
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800 text-red">
                                                            รอการตรวจสอบ</div>
                                                </div>
                                            @elseif($notification_id == 1)
                                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-red">
                                                    สามารสสอบได้</div>
                                            </div>
                                        @elseif($notification_id== 2)
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 text-red">
                                                สมบูรณ์</div>
                                        </div>
                                    @elseif($notification_id == 3)
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 text-red">
                                            รอดำเนินการต่อไป</div>
                                    </div>
            @endif
        @endisset


        </div>
        </div>

        </div>
        </div>
        </div>

        @endif
        @if (Auth::user()->hasRole('Tea'))
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
                            <!-- Area Chart -->
                            <div class="col-xl-6 col-lg-6">
                                <div class="card shadow mb-2">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            รายชื่อโปรเจดที่รับผิดชอบ(รอดำเนินการอยู่)
                                        </h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body ">
                                        <div class="mb-4">
                                            <div class="table-responsive table-striped">
                                                <table class="table table-bordered" id="dataTable" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ลำดับโครงงาน</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>
                                                            <th scope="col">หมายเหตุ</th>
                                                            {{-- <th scope="col">รายละเอียด</th>
                                                        <th scope="col">แก้ไข</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datas as $key => $row)
                                                            @if ($row->status == 'Check')
                                                                <tr>

                                                                    <th scope="row">{{ $key + 1 }}</th>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_th }}</a>
                                                                    </td>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_en }}</a>
                                                                    </td>
                                                                    <td>{{ $row->note }}</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach

                                                    </tbody>
                                                </table> {!! $datas->links() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">รอประเมินสอบ 50</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="table-responsive table-striped">
                                                <table class="table table-bordered" id="dataTable" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ลำดับโครงงาน</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>

                                                            {{-- <th scope="col">รายละเอียด</th>
                                                        <th scope="col">แก้ไข</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data_test50 as $key => $row)
                                                            @if ($row->status == 'Check')
                                                                <tr>
                                                                    <th scope="row">{{ $key + 1 }}</th>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_th }}</a>
                                                                    </td>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_en }}</a>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach

                                                    </tbody>
                                                </table> {!! $datas->links() !!}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <div class="card shadow mb-2">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            ประเมินสอบ 50 เสร็จสิ้น
                                        </h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body ">
                                        <div class="mb-4">
                                            <div class="table-responsive table-striped">
                                                <table class="table table-bordered" id="dataTable" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ลำดับโครงงาน</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>
                                                            <th scope="col">หมายเหตุ</th>
                                                            {{-- <th scope="col">รายละเอียด</th>
                                                        <th scope="col">แก้ไข</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($ProgressReport_test50_Success != null)
                                                            @foreach ($ProgressReport_test50_Success as $key => $row)
                                                                {{-- @if ($row->status == 'Check') --}}
                                                                <tr>

                                                                    <th scope="row">{{ $key + 1 }}</th>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_th }}</a>
                                                                    </td>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_en }}</a>
                                                                    </td>
                                                                    <td>{{ $row->note }}</td>
                                                                </tr>
                                                                {{-- @endif --}}
                                                            @endforeach
                                                        @endif

                                                    </tbody>
                                                </table>
                                                {{-- {!! $datas->links() !!} --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">รอประเมินสอบ 100</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="table-responsive table-striped">
                                                <table class="table table-bordered" id="dataTable" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ลำดับโครงงาน</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>
                                                            {{-- <th scope="col">รายละเอียด</th>
                                                        <th scope="col">แก้ไข</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data_test100 as $key => $row)
                                                            @if ($row->status == 'Check')
                                                                <tr>
                                                                    <th scope="row">{{ $key + 1 }}</th>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_th }}</a>
                                                                    </td>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_en }}</a>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach

                                                    </tbody>
                                                </table> {!! $datas->links() !!}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">ประเมินสอบ 100 เสร็จสิ้น</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="table-responsive table-striped">
                                                <table class="table table-bordered" id="dataTable" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ลำดับโครงงาน</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>
                                                            {{-- <th scope="col">รายละเอียด</th>
                                                        <th scope="col">แก้ไข</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($ProgressReport_test100_Success != null)
                                                            @foreach ($ProgressReport_test100_Success as $key => $row)
                                                                <tr>
                                                                    <th scope="row">{{ $key + 1 }}</th>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_th }}</a>
                                                                    </td>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_en }}</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">รอส่งแบบขอส่งโครงงานฉบับสมบูรณ์</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="table-responsive table-striped">
                                                <table class="table table-bordered" id="dataTable" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ลำดับโครงงาน</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>

                                                            {{-- <th scope="col">รายละเอียด</th>
                                                        <th scope="col">แก้ไข</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data_CompleteForm as $key => $row)
                                                            @if ($row->status == 'Check')
                                                                <tr>
                                                                    <th scope="row">{{ $key + 1 }}</th>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_th }}</a>
                                                                    </td>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_en }}</a>
                                                                    </td>

                                                                </tr>
                                                            @endif
                                                        @endforeach

                                                    </tbody>
                                                </table> {!! $datas->links() !!}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">โครงงานฉบับสมบูรณ์</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="table-responsive table-striped">
                                                <table class="table table-bordered" id="dataTable" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ลำดับโครงงาน</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>

                                                            {{-- <th scope="col">รายละเอียด</th>
                                                        <th scope="col">แก้ไข</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($Successfully_project != null)
                                                            @foreach ($Successfully_project as $key => $row)
                                                                <tr>
                                                                    <th scope="row">{{ $key + 1 }}</th>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_th }}</a>
                                                                    </td>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_en }}</a>
                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        @endif

                                                    </tbody>
                                                </table>
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
        @if (Auth::user()->hasRole('Admin'))
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
                            {!! Form::open(['action' => 'HomeController@search_project', 'method' => 'POST']) !!}
                            <div class="col-xl-5 col-lg-5">
                                <div class="my-4 row">
                                    <div class="col">
                                        {!! Form::select('subject', array_merge([$term_last[0]->year_term, $term]), null, ['class' => 'md-6 form-select']) !!}
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">ค้นหา</button>
                                    </div>

                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>

                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">สรุปผลรายปี
                                            {{ $term_last[0]->year_term }}</h6>


                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="table-responsive table-striped">
                                                <table class="table table-bordered" id="dataTable" width="100%"
                                                    cellspacing="0">
                                                    <div id="piechart"></div>
                                                    <div id="subject_list"></div>

                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="card shadow mb-2">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            รายชื่อโปรเจดที่รับผิดชอบ(รอดำเนินการอยู่)
                                        </h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body ">
                                        <div class="mb-4">
                                            <div class="table-responsive table-striped">
                                                <table class="table table-bordered" id="dataTable" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ลำดับโครงงาน</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>
                                                            <th scope="col">หมายเหตุ</th>
                                                            {{-- <th scope="col">รายละเอียด</th>
                                                        <th scope="col">แก้ไข</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($project as $key => $row)
                                                            @if ($row->status == 'Check')
                                                                <tr>
                                                                    <th scope="row">{{ $key + 1 }}</th>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_th }}</a>
                                                                    </td>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_en }}</a>
                                                                    </td>
                                                                    <td>{{ $row->note }}</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Area Chart -->

                            <div class="col-xl-6 col-lg-6">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">รอประเมินสอบ 50</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="table-responsive table-striped">
                                                <table class="table table-bordered" id="dataTable" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ลำดับโครงงาน</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>
                                                            {{-- <th scope="col">รายละเอียด</th>
                                                        <th scope="col">แก้ไข</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($test50 as $key => $row)
                                                            <tr>
                                                                <th scope="row">{{ $key + 1 }}</th>
                                                                <td><a target="_blank"
                                                                        href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_th }}</a>
                                                                </td>
                                                                <td><a target="_blank"
                                                                        href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_en }}</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">ประเมินสอบ 50 เสร็จสิ้น</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="table-responsive table-striped">
                                                <table class="table table-bordered" id="dataTable" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ลำดับโครงงาน</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>
                                                            {{-- <th scope="col">รายละเอียด</th>
                                                        <th scope="col">แก้ไข</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($ProgressReport_test50_Success != null)
                                                            @foreach ($ProgressReport_test50_Success as $key => $row)
                                                                {{-- @if ($row->status == 'Check') --}}
                                                                <tr>
                                                                    <th scope="row">{{ $key + 1 }}</th>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_th }}</a>
                                                                    </td>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_en }}</a>
                                                                    </td>
                                                                </tr>
                                                                {{-- @endif --}}
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">รอประเมินสอบ 100</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="table-responsive table-striped">
                                                <table class="table table-bordered" id="dataTable" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ลำดับโครงงาน</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>
                                                            {{-- <th scope="col">รายละเอียด</th>
                                                        <th scope="col">แก้ไข</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($test100 as $key => $row)
                                                            @if ($row->status == 'Check')
                                                                <tr>
                                                                    <th scope="row">{{ $key + 1 }}</th>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_th }}</a>
                                                                    </td>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_en }}</a>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">ประเมินสอบ 100 เสร็จสิ้น</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="table-responsive table-striped">
                                                <table class="table table-bordered" id="dataTable" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ลำดับโครงงาน</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>

                                                            {{-- <th scope="col">รายละเอียด</th>
                                                        <th scope="col">แก้ไข</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($ProgressReport_test100_Success != null)
                                                            @foreach ($ProgressReport_test100_Success as $key => $row)
                                                                {{-- @if ($row->status == 'Check') --}}
                                                                <tr>
                                                                    <th scope="row">{{ $key + 1 }}</th>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_th }}</a>
                                                                    </td>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_en }}</a>
                                                                    </td>

                                                                </tr>
                                                                {{-- @endif --}}
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">รอส่งแบบขอส่งโครงงานฉบับสมบูรณ์</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="table-responsive table-striped">
                                                <table class="table table-bordered" id="dataTable" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ลำดับโครงงาน</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>

                                                            {{-- <th scope="col">รายละเอียด</th>
                                                        <th scope="col">แก้ไข</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($CompleteForm as $key => $row)
                                                            @if ($row->status == 'Check')
                                                                <tr>
                                                                    <th scope="row">{{ $key + 1 }}</th>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_th }}</a>
                                                                    </td>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_en }}</a>
                                                                    </td>

                                                                </tr>
                                                            @endif
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">โครงงานฉบับสมบูรณ์</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="table-responsive table-striped">
                                                <table class="table table-bordered" id="dataTable" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ลำดับโครงงาน</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
                                                            <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>

                                                            {{-- <th scope="col">รายละเอียด</th>
                                                        <th scope="col">แก้ไข</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($Successfully_project != null)
                                                            @foreach ($Successfully_project as $key => $row)
                                                                {{-- @if ($row->status == 'Check') --}}
                                                                <tr>
                                                                    <th scope="row">{{ $key + 1 }}</th>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_th }}</a>
                                                                    </td>
                                                                    <td><a target="_blank"
                                                                            href="{{ route('CheckProject.info_project', $row->id) }}">{{ $row->name_en }}</a>
                                                                    </td>

                                                                </tr>
                                                                {{-- @endif --}}
                                                            @endforeach

                                                        @endif

                                                    </tbody>
                                                </table>
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
            <script type="text/javascript">
                // Load google charts
                google.charts.load('current', {
                    'packages': ['corechart']
                });
                google.charts.setOnLoadCallback(drawChart);

                // Draw the chart and set the chart values
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Task', 'Hours per Day'],
                        ['รอดำเนินการ',
                            {{ count($project) - count($test50) - count($test100) - count($CompleteForm) }}
                        ],
                        ['สอบ 50', {{ count($test50) }}],
                        ['สอบ 100', {{ count($test100) }}],
                        ['ส่งรูปเล่มสมบูรณ์', {{ count($CompleteForm) }}],
                        ['โปรเจคที่สมบูรณ์', {{ count($Successfully_project) }}]


                    ]);

                    // Optional; add a title and set the width and height of the chart
                    var options = {

                        'width': 450,
                        'height': 400
                    };

                    // Display the chart inside the <div> element with id="piechart"
                    var chart = new google.visualization.PieChart(document.getElementById(
                        'piechart'));
                    chart.draw(data, options);
                }

            </script>


        @endif
    @endsection

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>




</body>


</html>
