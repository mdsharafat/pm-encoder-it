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
            <legend><span class="number"><i class="fas fa-table"></i></span> Pending Leave Applications</legend>
        </fieldset>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Applicant</th>
                            <th>Department</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employeesLeave as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->employee->full_name }}</td>
                                <td>{{ $item->employee->department->name }}</td>
                                <td>
                                    <a href="{{ url('/leave-pending-unique-user/' . $item->emp_id) }}"><span class="badge bg-success my-custom-badge">{{ $item->totalPending }}</span></a>
                                </td>
                                <td>
                                    <a href="{{ url('/leave-pending-unique-user/' . $item->emp_id) }}" title="View All Leave Applications" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                    @can('approval-leave')
                                        <a href="{{ url('/approve-leave-all/'. $item->emp_id) }}" title="Approve All" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
                                        <a href="{{ url('/reject-leave-all/'. $item->emp_id) }}" title="Reject All" class="btn btn-warning btn-sm"><i class="fas fa-times"></i></a>
                                        <form method="POST" action="{{ url('/leave-managements' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Leave Application" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    @endcan
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
            $('#dataTable').DataTable();
        });
    </script>
@endsection