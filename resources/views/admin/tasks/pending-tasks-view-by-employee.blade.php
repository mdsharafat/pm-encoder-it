@extends('layouts.admin.master-layout')

@section('header-script')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('main-content')
    @if ($errors->any())
        <ul class="text-center" style="list-style: none;">
            @foreach ($errors->all() as $error)
                <li><h4 class="text-danger">{{ $error }}</h4></li>
            @endforeach
        </ul>
    @endif
    @if(Session::has('flashMessageError'))
        <h4 class="text-center text-danger">{{ Session::get('flashMessageError') }}</h4>
    @endif
    @if(Session::has('flashMessage'))
        <h4 class="text-center text-success">{{ Session::get('flashMessage') }}</h4>
    @endif
    <div class="form-style-5" style="padding-top: 0px; padding-bottom: 0px;">
        <fieldset>
            <legend><span class="number"><i class="fas fa-table"></i></span> Pending Tasks View By Employee</legend>
        </fieldset>
        @can('add-task')
            <a href="{{ url('/tasks/create') }}">
                <button class="customButton font-weight-bold">ADD NEW TASK</button>
            </a>
        @endcan
        @can('view-task')
            <a href="{{ url('/pending-feedback-tasks') }}">
                <button class="customButton font-weight-bold" style="background: teal;">ALL PENDING TASKS</button>
            </a>
        @endcan
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Tasks <span class="text-success font-weight-bold"><i class="fas fa-running"></i></span></th>
                            @can('view-task')
                            <th>Action</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->full_name }}</td>
                                <td>{{ $item->department->name }}</td>
                                <td>{{ $item->designation->name }}</td>
                                <td><a href="{{ url('/pending-all-task-view-by-employee/'.$item->id) }}"><span class="badge bg-success my-custom-badge">{{ $item->tasks->where('status', 4)->count() }}</span></a></td>
                                @can('view-task')
                                <td>
                                    <a href="{{ url('/pending-all-task-view-by-employee/'.$item->id) }}" title="View Employee" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('footer-script')
    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "columnDefs": [
                    { "width": "20px", "targets": 0 },
                    { "width": "150px", "targets": 1 },
                    { "width": "150px", "targets": 2 },
                    { "width": "150px", "targets": 3 },
                ],
            });
        });
    </script>
@endsection