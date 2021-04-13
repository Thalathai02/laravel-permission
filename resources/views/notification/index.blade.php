@extends('layouts.app')
@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
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
                            <h6 class="m-0 font-weight-bold text-primary">การแจ้งเตือนทั้งหมด</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body table-responsive">
                            <br>
                            @foreach ($notfi as $key => $value)
                                @if ($value->read_at)

                                    <a class="card-text d-flex align-items-center no-arrow"
                                        href="{!!  route('InfoWordTemplate.checkForm', ['form' => $value->data['form'], 'formId' => $value->data['form_id'], 'id_Notifications' => $value->id]) !!}">
                                        {{-- <div class="mr-3">
                                                <div class="icon-circle bg-primary">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500">{{ $value->created_at }}</div>
                                                <span class="text-truncate">{{ $value->data['userseed']['name'] }} <br>
                                                </span>
                                                <span class="font-weight">
                                                    {{ $value->data['Title_form'] }}
                                                </span>
                                            </div> --}}
                                        <div class="col-xl col-md mb">
                                            <div class="card border-left-success shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div
                                                                class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                                {{ $value->data['userseed']['name'] }}
                                                                <span class="icon">
                                                                    <i class="fas fa-check"></i>
                                                                </span>
                                                            </div>
                                                            <div class="h5 mb-0 font-text-truncate text-gray-800">
                                                                {{ $value->data['Title_form'] }}</div>
                                                                <p class="text-gray-900">{{$value->created_at}}</p>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <br>

                                @else

                                    <a class="card-text d-flex align-items-center"
                                        href="{!!  route('InfoWordTemplate.checkForm', ['form' => $value->data['form'], 'formId' => $value->data['form_id'], 'id_Notifications' => $value->id]) !!}">
                                        {{-- <div class="mr-3">
                                            <div class="icon-circle bg-primary">
                                                <i class="fas fa-file-alt text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">{{ $value->created_at }}</div>
                                            <span class="font-weight-bold">{{ $value->data['userseed']['name'] }} <br>
                                            </span>
                                            <span class="font-weight">
                                                {{ $value->data['Title_form'] }}
                                            </span>
                                        </div> --}}
                                        <div class="col-xl col-md mb">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div
                                                                class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                                {{ $value->data['userseed']['name'] }}</div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                                {{ $value->data['Title_form'] }}</div>
                                                                <p>{{$value->created_at}}</p>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <br>
                                @endif
                            @endforeach
                            {!! $notfi->links() !!}
                        </div>

                    </div>
                    <!-- Pie Chart -->

                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
    </div>
@endsection
