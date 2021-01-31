@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <br />

        <div class="container">
            <h3 align="center">Projects</h3>
            <br />


            @if (Auth::user()->hasRole('Admin'))
                <a href="/projects/into_project" class="btn btn-primary my-2" align="left">เพิ่มโปรเจค</a>
                <a href="/Check_Project" class="btn btn-warning my-2" align="left">ตรวจโปรเจค</a>
                <a href="" class="btn btn-info my-2" align="left">สถานะโปรเจค</a>
                <div class="mb-4">
                    <div class="table-responsive table-striped">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">ลำดับโครงงาน</th>
                                    <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
                                    <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>
                                    <th scope="col">หมายเหตุ</th>
                                    <th scope="col">รายละเอียด</th>
                                    <th scope="col">แก้ไข</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $row)
                                    @if ($row->status == 'Check')
                                        <tr>
                                            <th scope="row">{{ $row->id }}</th>
                                            <td>{{ $row->name_th }}</td>
                                            <td>{{ $row->name_en }}</td>
                                            <td></td>
                                            <td><a href="{{ route('Check_Project.show', $row->id) }}"
                                                    class="btn btn-info">รายละเอียด</a>
                                            </td>
                                            <td><a href="{{ route('project.edit', $row->id) }}"
                                                    class="btn btn-warning">แก้ไข</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            @if (Auth::user()->hasRole('Std'))

                @if ($data_std == null)

                    <a href="/projects/into_project" class="btn btn-primary my-2" align="left">เพิ่มโปรเจค</a>
                @endif
                @if (!empty($status))
                    @if ($status[0]->status == 'reject')
                        <a href="{{ route('info_project', Auth::user()->id) }}" class="btn btn-danger my-2"
                            align="left">ดูข้อมูลโปรเจด</a>

                    @endif

                    @if ($status[0]->status == 'Waiting')
                        <a href="{{ route('info_project', Auth::user()->id) }}" class="btn btn-primary my-2"
                            align="left">ดูข้อมูลโปรเจด</a>

                    @endif

                    @if ($status[0]->status == 'Check')
                        <a href="{{ route('info_project', Auth::user()->id) }}" class="btn btn-primary my-2"
                            align="left">ดูข้อมูลโปรเจด</a>



                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                            align="left">
                            ยืนแบบคำร้องต่าางๆ
                        </button>


                        <!-- Modal -->
                        <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ยืนแบบคำร้อง</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <a href="{{ route('project.test50', Auth::user()->id) }}">แบบเสนอขอสอบ50</a>
                                        </div>
                                        <div>
                                            <a href="{{ route('project.ProgressReport_test50', Auth::user()->id) }}">รายงานการสอบความก้าวหน้า
                                                (สอบ50)</a>
                                        </div>
                                        <div>
                                            <a
                                                href="{{ route('project.test100', Auth::user()->id) }}">แบบเสนอขอสอบ100</a>
                                        </div>
                                        <div>
                                            <a href="{{ route('project.ProgressReport_test100', Auth::user()->id) }}">รายงานการสอบความก้าวหน้า
                                                (สอบ100)</a>
                                        </div>
                                        <div>
                                            <a
                                                href="{{ route('project.CompleteForm', Auth::user()->id) }}">แบบขอส่งโครงงานฉบับสมบูรณ์</a>
                                        </div>
                                        <div>
                                            <a
                                                href="{{ route('project.ChangeBoard', Auth::user()->id) }}">ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์</a>
                                        </div>
                                        <div>
                                            <a
                                                href="{{ route('project.ChangeTopic', Auth::user()->id) }}">ขออนุญาตเปลี่ยนแปลงหัวข้อโครงงานคอมพิวเตอร์</a>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                @endif
                <div class="mb-4">
                    <div class="table-responsive table-striped">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">ลำดับโครงงาน</th>
                                    <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
                                    <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>
                                    <th scope="col">หมายเหตุ</th>
                                    <th scope="col">รายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $row)
                                    @if ($row->status == 'Check')
                                        <tr>
                                            <th scope="row">{{ $row->id }}</th>
                                            <td>{{ $row->name_th }}</td>
                                            <td>{{ $row->name_en }}</td>
                                            <td></td>
                                            <td><a href="{{ route('Check_Project.show', $row->id) }}"
                                                    class="btn btn-info">รายละเอียด</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @if (Auth::user()->hasRole('Tea'))

                <div class="mb-4">
                    <div class="table-responsive table-striped">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">ลำดับโครงงาน</th>
                                    <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
                                    <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>
                                    <th scope="col">หมายเหตุ</th>
                                    <th scope="col">รายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $row)
                                    @if ($row->status == 'Check')
                                        <tr>
                                            <th scope="row">{{ $row->id }}</th>
                                            <td>{{ $row->name_th }}</td>
                                            <td>{{ $row->name_en }}</td>
                                            <td></td>
                                            <td><a href="{{ route('Check_Project.show', $row->id) }}"
                                                    class="btn btn-info">รายละเอียด</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </body>

    </html>

@endsection
