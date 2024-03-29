@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">LeaveManagement {{ $leavemanagement->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/leave-managements') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/leave-managements/' . $leavemanagement->id . '/edit') }}" title="Edit LeaveManagement"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('leavemanagements' . '/' . $leavemanagement->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete LeaveManagement" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $leavemanagement->id }}</td>
                                    </tr>
                                    <tr><th> Emp Id </th><td> {{ $leavemanagement->emp_id }} </td></tr><tr><th> Status </th><td> {{ $leavemanagement->status }} </td></tr><tr><th> Category </th><td> {{ $leavemanagement->category }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
