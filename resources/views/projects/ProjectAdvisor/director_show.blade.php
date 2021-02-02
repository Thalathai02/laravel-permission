@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <br />

        <div class="container">
          <h3 align="center">โปรเจดที่เป็นกรรมการ</h3>
            <br />
            
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
                    {!! $datas->links() !!}
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $("#staticBackdrop").modal('show');
            });

        </script>


    </body>

    </html>

@endsection
