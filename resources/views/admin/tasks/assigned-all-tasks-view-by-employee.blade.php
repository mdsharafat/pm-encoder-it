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
            <legend><span class="number"><i class="fas fa-table"></i></span> Assigned/Reassigned/In progress - Tasks </legend>
        </fieldset>
        @can('add-task')
            <a href="{{ url('/tasks/create') }}">
                <button class="customButton font-weight-bold">ADD NEW TASK</button>
            </a>
        @endcan
        @can('view-task')
            <a href="{{ url('/tasks') }}">
                <button class="customButton font-weight-bold" style="background: teal;">ALL ASSIGNED TASKS</button>
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
                            <th>To</th>
                            <th>Project</th>
                            <th>Task</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employee->assignedTasks() as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->assignedTo->full_name }}</td>
                                <td>{{ Str::limit($item->project->title, 15) }}</td>
                                <td>{{ Str::limit($item->task, 30) }}</td>
                                <td>{{ $item->deadline }}</td>
                                <td> <span class="badge @if($item->status ==1 ) {{ 'bg-primary' }} @elseif($item->status ==2) {{ 'bg-danger' }} @elseif($item->status ==3) {{ 'bg-info' }} @elseif($item->status ==4) {{ 'bg-warning' }} @else {{ 'bg-success' }} @endif my-custom-badge"> {{ $item->statusName($item->status) }} </span> </td>
                                <td>
                                    <a href="{{ url('/tasks/' . $item->unique_key) }}" title="View Task" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                    <a href="{{ url('/tasks/' . $item->id . '/edit') }}" title="Edit Task" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>

                                    <form method="POST" action="{{ url('/tasks' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Task" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
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
                    { "width": "60px", "targets": 1 },
                    { "width": "130px", "targets": 2 },
                    { "width": "100px", "targets": 4 },
                    { "width": "50px", "targets": 5 },
                    { "width": "100px", "targets": 6 },
                ],
            });
        });
    </script>
@endsection