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
            <legend><span class="number"><i class="fas fa-table"></i></span> Miscellaneous Expenses Table</legend>
        </fieldset>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Name</th>
                            <th>Amount ($)</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($miscellaneousExpenses as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td><td>{{ $item->amount }}</td><td>{{ $item->date }}</td>
                                <td>
                                    <a href="{{ url('/miscellaneous-expenses/' . $item->id) }}" title="View MiscellaneousExpense" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                    <a href="{{ url('/miscellaneous-expenses/' . $item->id . '/edit') }}" title="Edit MiscellaneousExpense" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>

                                    <form method="POST" action="{{ url('/miscellaneous-expenses' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete MiscellaneousExpense" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt"></i></button>
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

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "columnDefs": [
                    { "width": "20px", "targets": 0 },
                    { "width": "500px", "targets": 1 },
                    { "width": "100px", "targets": 4 },
                ],
            });
        });
    </script>
@endsection