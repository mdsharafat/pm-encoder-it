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
        @role('Admin')
            <a href="{{ url('/projects/create') }}">
                <button class="customButton font-weight-bold">ADD NEW PROJECT</button>
            </a>
        @endrole
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Title</th>
                            @role('Admin')
                            <th>Deadline</th>
                            <th>Client</th>
                            <th>Platform</th>
                            <th>Budget</th>
                            @endrole
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucfirst($item->title) }}</td>
                                @role('Admin')
                                <td>{{ Carbon\Carbon::parse($item->deadline)->format('D jS F, Y') }}</td>
                                <td>{{ $item->client->name }}</td>
                                <td>{{ $item->platform->name }}</td>
                                <td class="font-weight-bold">{{ $item->budget." $" }}</td>
                                @endrole
                                <td><span class="badge my-custom-badge @if($item->status == 1) {{ 'bg-success' }} @else {{ 'bg-danger' }} @endif">{{ $item->statusName($item->status) }}</span></td>
                                <td>
                                    <a href="{{ url('/projects/' . $item->unique_key) }}" title="View Project" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                    @role('Admin')
                                    <a href="{{ url('/projects/' . $item->unique_key . '/edit') }}" title="Edit Project" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                    <form method="POST" action="{{ url('/projects' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Project" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                    @endrole
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
                    { "width": "200px", "targets": 1 },
                    { "width": "50px", "targets": 2 },
                    { "width": "100px", "targets": 3 },
                    { "width": "70px", "targets": 6 },
                    { "width": "100px", "targets": 7 },
                ],
            });
        });
    </script>
@endsection
