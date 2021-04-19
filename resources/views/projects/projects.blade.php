@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <br />

        <div class="container">
            <h3 align="center">โครงานทั้งหมด (ยังไม่ได้เผยแพร่)</h3>
            <br />
            @if (Auth::user()->hasRole('Admin'))
                {{-- <a href="/projects/into_project" class="btn btn-primary my-2" align="left">เพิ่มโปรเจค</a>
                <a href="/Selection_yearCheck_Project" class="btn btn-warning my-2" align="left">ตรวจโปรเจค</a> --}}
                {{-- <a href="" class="btn btn-info my-2" align="left">สถานะโปรเจค</a> --}}
                <div class="mb-4">
                    <div class="responsive">
                        <div class="row">
                            @foreach ($datas as $key => $row)
                                @if ($row[0]->status == 'Check')
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="card shadow mb-4">
                                            <!-- Card Header - Dropdown -->
                                            <div
                                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold text-primary">{{ $row[0]->name_th }}
                                                    {{ $row[0]->name_en }}</h6>
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                        aria-labelledby="dropdownMenuLink">
                                                        <div class="dropdown-header">ตัวเลือก:</div>
                                                        <a class="dropdown-item"
                                                            href="{{ route('project.edit', $row[0]->id) }}">แก้ไข</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('Check_Project.show', $row[0]->id) }}">รายละเอียด</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Card Body -->
                                            <div class="card-body">
                                                <div class="card-body">
                                                    <p>จัดทำโดย</p>
                                                    <p class="mb-0">
                                                        @foreach ($row as $key => $rows)
                                                            {{ $rows->name }},
                                                        @endforeach
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            @endforeach
                        </div>

                        {!! $datas->links() !!}
                    </div>
                </div>
            @endif
            @if (Auth::user()->hasRole('Std'))

                @if ($data_std == null)
                    <a href="/projects/into_project" class="btn btn-primary my-2" align="left">เพิ่มโปรเจค</a>
                @endif

                @if (!empty($status))
                    @if ($status[0]->status == 'Waiting')
                        <a href="{{ route('info_project', Auth::user()->id) }}" class="btn btn-primary my-2"
                            align="left">ดูข้อมูลโปรเจด</a>

                    @endif

                    @if ($status[0]->status == 'Check')
                        <a href="{{ route('info_project', Auth::user()->id) }}" class="btn btn-primary my-2"
                            align="left">ดูข้อมูลโปรเจด</a>

                    @endif

                @endif
                <div class="mb-4">
                    <div class="responsive">
                        <div class="row">
                            @foreach ($datas as $key => $row)
                                @if ($row[0]->status == 'Check')
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="card shadow mb-4">
                                            <!-- Card Header - Dropdown -->
                                            <div
                                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold text-primary">{{ $row[0]->name_th }}
                                                    {{ $row[0]->name_en }}</h6>
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                        aria-labelledby="dropdownMenuLink">
                                                        <div class="dropdown-header">ตัวเลือก :</div>

                                                        <a class="dropdown-item"
                                                            href="{{ route('Check_Project.show', $row[0]->id) }}">รายละเอียด</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Card Body -->
                                            <div class="card-body">
                                                <div class="card-body">
                                                    <p>จัดทำโดย</p>
                                                    <p class="mb-0">
                                                        @foreach ($row as $key => $rows)
                                                            {{ $rows->name }},
                                                        @endforeach
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        {!! $datas->links() !!}
                    </div>
                </div>
            @endif

            @if (Auth::user()->hasRole('Tea'))

                <div class="mb-4">
                    <div class="responsive">
                        <div class="row">
                            @foreach ($datas as $key => $row)
                                @if ($row[0]->status == 'Check')
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="card shadow mb-4">
                                            <!-- Card Header - Dropdown -->
                                            <div
                                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold text-primary">{{ $row[0]->name_th }}
                                                    {{ $row[0]->name_en }}</h6>
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                        aria-labelledby="dropdownMenuLink">
                                                        <div class="dropdown-header">ตัวเลือก :</div>

                                                        <a class="dropdown-item"
                                                            href="{{ route('Check_Project.show', $row[0]->id) }}">รายละเอียด</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Card Body -->
                                            <div class="card-body">
                                                <div class="card-body">
                                                    <p>จัดทำโดย</p>
                                                    <p class="mb-0">
                                                        @foreach ($row as $key => $rows)
                                                            {{ $rows->name }},
                                                        @endforeach
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            @endforeach
                        </div>

                        {!! $datas->links() !!}
                    </div>
                </div>
            @endif
        </div>
    </body>

    </html>

@endsection
