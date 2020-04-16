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
            <hr>
            <div class="row text-left">
                <div class="col-md-2">
                    <h5 clas="text-center">Name</h5>
                </div>
                <div class="col-md-10">
                    <h5 clas="text-center">: <span class="font-weight-bold">{{ $employeeName->full_name }}</span></h5>
                </div>
            </div>
            <div class="row text-left">
                <div class="col-md-2">
                    <h5 clas="text-center">Department</h5>
                </div>
                <div class="col-md-10">
                    <h5 clas="text-center">: <span class="font-weight-bold">{{ $employeeName->department->name }}</span></h5>
                </div>
            </div>
            <div class="row text-left">
                <div class="col-md-2">
                    <h5 clas="text-center">Application Status</h5>
                </div>
                <div class="col-md-10">
                    <h5 clas="text-center">: <span class="font-weight-bold text-success">{{ 'Approved' }}</span></h5>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>Category</th>
                            <th>Date</th>
                            <th>Reason</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leaveApproved as $item)
                            <tr class="text-center">
                                <td>{{ $item->categoryName($item->category) }}</td>
                                <td>{{ $item->date }}</td>
                                <td>{{ $item->reason }}</td>
                                <td>
                                    <a href="{{ url('/reject-leave-single/'.$item->id.'/'. $item->emp_id) }}" title="Reject" class="btn btn-warning btn-sm"><i class="fas fa-times"></i></a>
                                    <form method="POST" action="{{ url('/leave-managements' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Leave Application" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt"></i></button>
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
                    { "width": "450px", "targets": 2 },
                ],
            });
        });
    </script>
@endsection