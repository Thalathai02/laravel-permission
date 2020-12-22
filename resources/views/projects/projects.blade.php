@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <br />

        <div class="container">
            <h3 align="center">Projects</h3>
            <br />
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (Auth::user()->hasRole('Admin'))
                <a href="/projects/into_project" class="btn btn-primary my-2" align="left">เพิ่มโปรเจค</a>
                <a href="/Check_Project" class="btn btn-warning my-2" align="left">ตรวจโปรเจค</a>
                <a href="" class="btn btn-info my-2" align="left">สถานะโปรเจค</a>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับโครงงาน</th>
                            <th scope="col">รหัสนักศึกษา</th>
                            <th scope="col">ชื่อ-สกุล</th>
                            <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
                            <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>
                            <th scope="col">ที่ปรึกษาพิเศษ</th>
                            <th scope="col">หมายเหตุ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $row)
                            @if ($row->status == 'Check')
                                <tr>
                                    <th scope="row">{{ $row->Project_id }}</th>
                                    <td>{{ $row->std_code }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->name_th }}</td>
                                    <td>{{ $row->name_en }}</td>
                                    <td>{{ $row->name_mentor }}</td>
                                    <td></td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @endif
            @if (Auth::user()->hasRole('Std'))

                @if ($data_std == null)

                    <a href="/projects/into_project" class="btn btn-primary my-2" align="left">เพิ่มโปรเจค</a>
                @endif
                @if (!empty($status))
                    @if ($status[0]->status == 'reject')
                        <a href="{{ route('project.edit', Auth::user()->id) }}" class="btn btn-danger my-2"
                            align="left">แก้ไขโปรเจค</a>
                            
                    @endif

                    @if ($status[0]->status == 'not Check')
                        <a href="{{ route('project.edit', Auth::user()->id) }}" class="btn btn-primary my-2"
                            align="left">แก้ไขโปรเจค</a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
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
                                            <a href="">แบบเสนอขอสอบ50</a>
                                        </div>
                                        <div>
                                            <a href="">รายงานการสอบความก้าวหน้า</a>
                                        </div>
                                       <div>
                                           <a href="">แบบเสนอขอสอบ100</a>
                                       </div>
                                        <div>
                                            <a href="">แบบขอส่งโครงงานฉบับสมบูรณ์</a>
                                        </div>
                                        <div>
                                            <a href="">รายงานผลการสอบโครงงานคอมพิวเตอร์</a>
                                        </div>
                                        <div>
                                            <a href="">ขออนุญาตเปลี่ยนแปลงคณะกรรมการโครงงานคอมพิวเตอร์</a>
                                        </div>
                                        <div>
                                            <a href="">ขออนุญาตเปลี่ยนแปลงหัวข้อโครงงานคอมพิวเตอร์</a>
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
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับโครงงาน</th>
                            <th scope="col">รหัสนักศึกษา</th>
                            <th scope="col">ชื่อ-สกุล</th>
                            <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
                            <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>
                            <th scope="col">ที่ปรึกษาพิเศษ</th>
                            <th scope="col">หมายเหตุ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $row)
                            @if ($row->status == 'Check')
                                <tr>
                                    <th scope="row">{{ $row->Project_id }}</th>
                                    <td>{{ $row->std_code }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->name_th }}</td>
                                    <td>{{ $row->name_en }}</td>
                                    <td>{{ $row->name_mentor }}</td>
                                    <td></td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @endif

            @if (Auth::user()->hasRole('Tea'))


                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับโครงงาน</th>
                            <th scope="col">รหัสนักศึกษา</th>
                            <th scope="col">ชื่อ-สกุล</th>
                            <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
                            <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>
                            <th scope="col">ที่ปรึกษาพิเศษ</th>
                            <th scope="col">หมายเหตุ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $row)
                            @if ($row->status == 'Check')
                                <tr>
                                    <th scope="row">{{ $row->Project_id }}</th>
                                    <td>{{ $row->std_code }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->name_th }}</td>
                                    <td>{{ $row->name_en }}</td>
                                    <td>{{ $row->name_mentor }}</td>
                                    <td></td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </body>

    </html>

@endsection
