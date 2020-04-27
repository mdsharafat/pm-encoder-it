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
            <legend><span class="number"><i class="fas fa-table"></i></span> Projects Table</legend>
        </fieldset>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucfirst($item->title) }}</td>
                                <td><span class="badge my-custom-badge @if($item->status == 1) {{ 'bg-success' }} @else {{ 'bg-danger' }} @endif">{{ $item->statusName($item->status) }}</span></td>
                                <td>
                                    <a href="{{ url('/projects/' . $item->id) }}" title="View Project" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
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
                    { "width": "400px", "targets": 1 },
                    { "width": "100px", "targets": 3 },
                ],
            });
        });
    </script>
@endsection