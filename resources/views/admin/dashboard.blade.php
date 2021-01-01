@extends('layouts.admin.master-layout')

@section('header-script')

@endsection

@section('main-content')
    @role('Admin')
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
            </div>
            <!-- Content Row -->
            <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ url('/miscellaneous-expenses') }}" style="text-decoration:none;">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Expense (Current Month)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">${{ $totalExpense }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ url('/credits') }}" style="text-decoration:none;">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Current Month)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">${{ $totalEarning }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Task Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ url('/tasks') }}" style="text-decoration:none;">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Running Projects</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">%</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ url('/leave-managements') }}" style="text-decoration:none;">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Leave Application</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingLeaves }}</div>
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

        <!-- Content Row -->
        @if($projects->count() > 0)
            <div class="row">
                <div class="col-lg-12 mb-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Running Projects</h6>
                        </div>
                        <div class="card-body">
{{--                            @foreach ($projects as $project)--}}
{{--                                <h4 class="small font-weight-bold">{{ $project->title }} <span class="float-right">{{ number_format($project->percentageOfCompletion(), 2) }}%</span></h4>--}}
{{--                                <div class="progress mb-4">--}}
{{--                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ number_format($project->percentageOfCompletion(), 2) }}%" aria-valuenow="{{ $project->percentageOfCompletion() }}" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endrole
@endsection

@section('footer-script')
<!-- Page level plugins -->
<script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
{{-- <script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script> --}}

@endsection
