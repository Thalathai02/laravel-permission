@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <br />

        <div class="container">
            <h3 align="center">ประเมินการสอบ50</h3>
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
                        </table> {!! $datas->links() !!}
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
                                    
                                    <th scope="col">ประเมินการสอบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data_test50==null)
                                    
                               @else
                                @foreach ($data_test50 as $row)
                                    @if ($row->status == 'Check')
                                        <tr>
                                            <th scope="row">{{ $row->id }}</th>
                                            <td>{{ $row->name_th }}</td>
                                            <td>{{ $row->name_en }}</td>
                                            
                                            <td><a href="{{ route('comment_test50_id', $row->id) }}"
                                                class="btn btn-danger">ประเมินการสอบ</a>
                                        </td>
                                        </tr>
                                    @endif
                                @endforeach  
                                @endif                             
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            @endif
        </div>
    </body>

    </html>

@endsection
