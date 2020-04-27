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
            <legend><span class="number"><i class="fas fa-table"></i></span> Pending Feedback Tasks</legend>
        </fieldset>
        @can('add-task')
            <a href="{{ url('/tasks/create') }}">
                <button class="customButton font-weight-bold">ADD NEW TASK</button>
            </a>
        @endcan
        @can('view-task')
            <a href="{{ url('/pending-tasks-view-by-employee') }}">
                <button class="customButton font-weight-bold" style="background: teal;">VIEW BY EMPLOYEE</button>
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
                            <th>To</th>
                            <th>Project</th>
                            <th>Task</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->assignedTo->full_name }}</td>
                                <td>{{ Str::limit($item->project->title, 15) }}</td>
                                <td>{{ Str::limit($item->task, 30) }}</td>
                                <td>{{ $item->deadline }}</td>
                                <td> <span class="badge bg-warning my-custom-badge"> {{ $item->statusName($item->status) }} </span> </td>
                                <td>
                                    <a href="#myModal" data-toggle="modal" unique_key="{{ $item->unique_key }}" total_point="{{ $item->total_point }}" title="Feedback" class="btn btn-success btn-sm feedback_btn"><i class="fas fa-thumbs-up"></i></a>
                                    <a href="{{ url('/reassign-task/' . $item->unique_key) }}" title="Reassign" class="btn btn-warning btn-sm"><i class="fas fa-redo-alt"></i></a>
                                    <a href="{{ url('/tasks/'.$item->unique_key) }}" title="View Task" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="{{ url('/tasks/' . $item->id . '/edit') }}" title="Edit Task" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>

                                    <form method="POST" action="{{ url('/tasks' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Task" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>




                <div class="container">
                    <form class="form-style-5" action="{{ url('/task-feedback') }}" method="post">
                        {{ method_field('PATCH') }}
                        @csrf
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title text-left">Task Feedback</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="dynamic_modal_elem">

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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
                    { "width": "60px", "targets": 1 },
                    { "width": "100px", "targets": 2 },
                    { "width": "130px", "targets": 3 },
                    { "width": "100px", "targets": 4 },
                    { "width": "50px", "targets": 5 },
                ],
            });

            $(document).on('click', '.feedback_btn', function(){
                $('.dynamic_modal_elem').empty();
                let uniqueKey = $(this).attr('unique_key');
                let totalPoint = $(this).attr('total_point');
                var html = `<input type="hidden" name="unique_key" value="`+uniqueKey+`">
                            <label>Total Point Assigned: <span class="badge bg-success my-custom-badge">`+totalPoint+`</span></label>
                            <label for="received_point">Give Feedback</label>
                            <select id="received_point" name="received_point" required >
                                <option value="00.00">00.00</option>
                                <option value="01.00">01.00</option>
                                <option value="02.00">02.00</option>
                                <option value="03.00">03.00</option>
                                <option value="04.00">04.00</option>
                                <option value="05.00">05.00</option>
                                <option value="06.00">06.00</option>
                                <option value="07.00">07.00</option>
                                <option value="08.00">08.00</option>
                                <option value="09.00">09.00</option>
                                <option value="10.00">10.00</option>
                                <option value="11.00">11.00</option>
                                <option value="12.00">12.00</option>
                                <option value="13.00">13.00</option>
                                <option value="14.00">14.00</option>
                                <option value="15.00">15.00</option>
                                <option value="16.00">16.00</option>
                                <option value="17.00">17.00</option>
                                <option value="18.00">18.00</option>
                                <option value="19.00">19.00</option>
                                <option value="20.00">20.00</option>
                            </select>`;
                $('.dynamic_modal_elem').append(html);
            });
        });
    </script>
@endsection