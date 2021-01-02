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
            <legend><span class="number"><i class="fas fa-table"></i></span> Contributions Table</legend>
        </fieldset>
        @can('add-employee')
            <a href="{{ url('/contributions/create') }}">
                <button class="customButton font-weight-bold">ADD NEW CONTRIBUTION</button>
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
                            <th>Project</th>
                            <th>Total Employee</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contributions as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->project->title }}</td>
                                <td><a href="{{ url('/project-wise-contribution/' . $item->unique_key) }}"><span class="badge bg-success my-custom-badge">{{ $item->totalEmployee }}</span></a></td>
                                <td>
                                    <a href="{{ url('/project-wise-contribution/' . $item->unique_key) }}" title="View Contribution" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
{{--                                    <a href="{{ url('/contributions/' . $item->id . '/edit') }}" title="Edit Contribution" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>--}}

                                    <form method="POST" action="{{ url('/project-wise-delete-contribution') }}" accept-charset="UTF-8" style="display:inline">
                                        <input type="hidden" name="project" value="{{ $item->project_id }}">
                                        <input type="hidden" name="unique_key" value="{{ $item->unique_key }}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Contribution" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt"></i></button>
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
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
@endsection