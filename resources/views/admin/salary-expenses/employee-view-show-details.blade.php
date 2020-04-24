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
            <legend><span class="number"><i class="fas fa-table"></i></span> Salary Expenses Table</legend>
            <hr>
            <div class="row text-left">
                <div class="col-md-2">
                    <h5 clas="text-center">Name</h5>
                </div>
                <div class="col-md-10">
                    <h5 clas="text-center">: <span class="font-weight-bold">{{ $employee->full_name }}</span></h5>
                </div>
            </div>
            <div class="row text-left">
                <div class="col-md-2">
                    <h5 clas="text-center">Department</h5>
                </div>
                <div class="col-md-10">
                    <h5 clas="text-center">: <span class="font-weight-bold">{{ $employee->department->name }}</span></h5>
                </div>
            </div>
            <div class="row text-left">
                <div class="col-md-2">
                    <h5 clas="text-center">Designation</h5>
                </div>
                <div class="col-md-10">
                    <h5 clas="text-center">: <span class="font-weight-bold">{{ $employee->designation->name }}</span></h5>
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
                            <th>#</th>
                            <th>Date</th>
                            <th>Amount ($)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employee->salaries as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ Carbon\Carbon::parse($item->date)->format('jS \\of F, Y') }}</td>
                                <td>{{ $item->amount }}</td>
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

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "columnDefs": [
                    { "width": "20px", "targets": 0 },
                ],
            });
        });
    </script>
@endsection