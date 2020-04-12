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
            <legend><span class="number"><i class="fas fa-table"></i></span> User Table</legend>
        </fieldset>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Role</th>
                        @can('edit-user')
                            <th>Updated By</th>
                        @endcan
                        @canany(['edit-user', 'delete-user'])
                            <th>Action</th>
                        @endcanany   
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($item->image != null)
                                        <img style="width: 25px; height: 25px; margin: 0 auto; border-radius: 50%;" src="{{ asset('storage/users/'.$item->image) }}" alt="image">
                                    @else
                                        <img style="width: 25px; height: 25px; margin: 0 auto; border: 1px solid #cecece; border-radius: 50%;" src="{{ asset('assets/img/user.jpg') }}" alt="image">
                                    @endif
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    @if($item->status == 0)
                                        <span class="badge bg-danger" style="color: #ffffff; padding: 5px; font-weight: bold;">Inactive</span>
                                    @else                        
                                        <span class="badge bg-success" style="color: #ffffff; padding: 5px; font-weight: bold;">Active</span>
                                    @endif
                                </td>
                                <td>
                                    @foreach($item->getRoleNames() as $role)
                                        @if($role == 'Super Admin')
                                            <span class="badge bg-danger" style="color: #ffffff; padding: 5px; font-weight: bold;"> {{ $role }} </span>
                                        @elseif($role == 'Admin')
                                            <span class="badge bg-warning" style="color: #ffffff; padding: 5px; font-weight: bold;"> {{ $role }} </span>
                                        @else
                                            <span class="badge bg-success" style="color: #ffffff; padding: 5px; font-weight: bold;"> {{ $role }} </span>
                                        @endif
                                    @endforeach
                                </td>
                                @can('edit-user')
                                    <td>{{ $item->updated_by }}</td>
                                @endcan
                                @canany(['edit-user', 'delete-user'])
                                    <td> 
                                        @can('edit-user')
                                            <a href="{{ url('/users/'.$item->id.'/edit') }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                        @if(Auth::user()->id != $item->id)
                                            @can('delete-user')
                                                <form method="POST" action="{{ url('/users' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(&quot;Confirm delete?&quot;)"> <i class="fas fa-trash-alt"></i> </button>
                                                </form>
                                            @endcan
                                        @endif                                
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
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
@endsection