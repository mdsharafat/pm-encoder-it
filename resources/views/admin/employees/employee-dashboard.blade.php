@extends('layouts.admin.master-layout')

@section('header-script')

@endsection

@section('main-content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
        </div>
        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ url('/projects') }}" style="text-decoration:none;">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Running Projects</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $projects->count }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ url('/my-assigned-tasks') }}" style="text-decoration:none;">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Assigned Tasks</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $assignedTasks->count }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ url('/my-in-progress-tasks') }}" style="text-decoration:none;">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">In Progress Tasks</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $inProgressTasks->count }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ url('/my-completed-tasks') }}" style="text-decoration:none;">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Submitted Tasks</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $submittedTasks->count }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ url('/my-leave-applications-pending') }}" style="text-decoration:none;">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Leave Approval</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $appliedLeaves->count }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ url('/my-leave-applications-summary') }}" style="text-decoration:none;">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Approved Leave</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $approvedLeaves->count }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('footer-script')
<!-- Page level plugins -->
<script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
{{-- <script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script> --}}

@endsection