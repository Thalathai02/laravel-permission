@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <br />

        <div class="container">
            <h3 align="center" class="mb-4">Check Projects</h3>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ลำดับโครงงาน</th>
                        <th scope="col">ชื่อโครงงาน (ภาษาไทย)</th>
                        <th scope="col">ชื่อโครงงาน (ภาษาอังกฤษ)</th>
                        <th scope="col">หมายเหตุ</th>
                        <th scope="col">รายละเอียด</th>
                        <th scope="col">แต่งตั้งประธาน</th>
                        <th scope="col">ผ่าน</th>
                        </th>
                        <th scope="col">ไม่ผ่าน</th>
                        <th scope="col">แก้ไข</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $key => $row)
                        @if ($row->status == 'Waiting')
                            <tr>
                                <td scope="row">{{ $key + 1 }}</td>
                                <td>{{ $row->name_th }}</td>
                                <td>{{ $row->name_en }}</td>
                                <td></td>
                                <td><a href="{{ route('Check_Project.show', $row->id) }}"
                                        class="btn btn-info">รายละเอียด</a></td>
                                <td><a href="{{ route('Check_Project.edit', $row->id) }}"
                                        class="btn btn-success">แต่งตั้งประธาน</a>
                                </td>
                                <td>
                                    <a href="{{ route('Check_Project.success_check', $row->id) }}"
                                        class="btn btn-primary">ผ่าน</a>
                                </td>
                                <td>
                                    <form action="{{ route('Check_Project.destroy', $row->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        {{-- <input type="submit" value="ไม่ผ่าน" data-name="{{ $row->name_th }}"
                                            class="btn btn-danger rejectProject"> --}}

                                        <!-- Button trigger modal -->
                                        <input type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#exampleModal" value="ไม่ผ่าน">
                                        </input>



                                        <!-- Modal -->
                                        <div class="modal fade " id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">คุณต้องการให้โครงการ
                                                            {{ $row->name_th }} ไม่ผ่านหรือไม่ ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div>
                                                            {!! Form::label('reject', 'สาเหตุที่ไม่ผ่าน') !!}
                                                            {!! Form::text('reject', null, ['class' => 'form-control']) !!}
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">ยกเลิก</button>
                                                        <button type="submit" class="btn btn-danger">ยืนยัน</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td><a href="{{ route('project.edit', $row->id) }}" class="btn btn-warning">แก้ไข</td>

                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>

    </html>

@endsection
