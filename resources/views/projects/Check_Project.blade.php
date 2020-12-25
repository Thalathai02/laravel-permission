@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <br />

        <div class="container">
            <h3 align="center">Check Projects</h3>
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
            
            <div class="progress ">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="20" aria-valuemax="100" style="width: 25%">นำเสนอหัวข้อ</div>
              </div>
              

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ลำดับโครงงาน</th>
                        <th scope="col">ชื่อโครงงาน (ภาษาไทย)</th>
                        <th scope="col">ชื่อโครงงาน (ภาษาอังกฤษ)</th>
                        <th scope="col">หมายเหตุ</th>
                        <th scope="col">รายละเอียด</th>
                        <th scope="col">แต่งตั้งประธาน</th>
                        <th scope="col">ส่งคืน</th>
                        <th scope="col">แก้ไข</th>

                    </tr>
                </thead>


                <tbody>
                    @foreach ($datas as $row)
                        @if ($row->status == 'not Check')
                            <tr>
                                <td scope="row">{{ $row->id }}</td>
                                <td>{{ $row->name_th }}</td>
                                <td>{{ $row->name_en }}</td>
                                <td></td>
                                <td><a href="{{ route('Check_Project.show', $row->id) }}"
                                        class="btn btn-info">รายละเอียด</a></td>
                                <td><a href="{{ route('Check_Project.edit', $row->id) }}"
                                        class="btn btn-success">แต่งตั้งประธาน</a></td>
                                <td>
                                    <form action="{{ route('Check_Project.destroy', $row->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <input type="submit" value=" ส่งคืน" data-name="{{ $row->name_th }}"
                                            class="btn btn-danger rejectProject">
                                    </form>
                                </td>
                                <td><a  href="{{ route('project.edit', $row->id) }}" class="btn btn-warning">แก้ไข</td>
                                    
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>

    </html>

@endsection
