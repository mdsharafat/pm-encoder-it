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
            <legend><span class="number"><i class="fas fa-table"></i></span> Employees Table</legend>
        </fieldset>
        @can('add-employee')
            <a href="{{ url('/employees/create') }}">
                <button class="customButton font-weight-bold">ADD NEW EMPLOYEE</button>
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
                            <th>Projects <span class="text-success font-weight-bold"><i class="fas fa-running"></i></span></th>
                            @canany(['edit-employee', 'view-employee-details', 'delete-employee'])
                            <th>Action</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($employees as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->full_name }}</td>
                                <td>{{ $item->department->name }}</td>
                                <td>{{ $item->designation->name }}</td>
                                <td><a href="{{ url('/all-running-projects-single-employee/'.$item->unique_key) }}"><span class="badge bg-success my-custom-badge">{{ $item->runningProjects()->count() }}</span></a></td>
                                @canany(['edit-employee', 'view-employee-details', 'delete-employee'])
                                <td>
                                    @can('view-employee-details')
                                    <a href="{{ url('/employees/' . $item->unique_key) }}" title="View Employee" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                    @endcan
                                    @can('edit-employee')
                                    <a href="{{ url('/employees/' . $item->unique_key . '/edit') }}" title="Edit Employee" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                    @endcan
                                    @can('delete-employee')
                                    <form method="POST" action="{{ url('/employees' . '/' . $item->unique_key) }}" accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Employee" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                    @endcan
                                </td>
                                @endcanany
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
                    { "width": "150px", "targets": 5 },
                ],
            });
        });
    </script>
@endsection
