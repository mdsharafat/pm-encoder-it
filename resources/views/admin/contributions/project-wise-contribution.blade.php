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
            <legend><span class="number"><i class="fas fa-table"></i></span> Project Wise Contribution Table</legend>
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
                        <th>Project Name</th>
                        <th>Employee Name</th>
                        <th>Contribution</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($projectWiseContribution as $item)
                        <tr class="text-center">
                            <td>{{ $item->project->title }}</td>
                            <td>{{ $item->employee->full_name }}</td>
                            <td>
                                <div class="progress mb-4">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $item->contribution }}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">{{ $item->contribution }}%</div>
                                </div>
                            <td>
                                <a href="{{ url('/contributions/' . $item->unique_key. $item->emp_id . '/edit') }}" title="Edit Contribution" class="btn btn-primary btn-sm edit_button" unique-key=" {{ $item->unique_key }} " contribution = "{{ $item->contribution }}" project = "{{ $item->project_id }}" employee = "{{ $item->emp_id }}" data-toggle="modal" data-target="#editContributionModal"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ url('/employee-wise-delete-contribution') }}" accept-charset="UTF-8" style="display:inline">
                                    <input type="hidden" name="project" value="{{ $item->project_id }}">
                                    <input type="hidden" name="employee" value="{{ $item->emp_id }}">
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


    <!-- Modal -->
    <div class="modal fade contribution_modal" id="editContributionModal" tabindex="-1" role="dialog" aria-labelledby="editContributionModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editContributionModalTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-style-5">
                        <form>
                            <div class="form-group">
                                <input type="hidden" name="emp_id_form" class="emp_id_form" id="emp_id_form">
                                <input type="hidden" name="project_id_form" class="project_id_form" id="project_id_form">
                                <input type="hidden" name="unique_key_form" class="unique_key_form" id="unique_key_form">
                                <label for="contribution" class="control-label"><span class="remaing_contribution">Contribution (%)</span></label>
                                <input required type="number" class="contribution_form" name="contribution_form" id="contribution_form" placeholder="contribution *" value="" >
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success update_contribution">Save changes</button>
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
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
    <script type="text/javascript">

        $(document).ready(function(){
            $(document).on('click', '.edit_button', function(){
                let uniqueKey    = $(this).attr('unique-key');
                let contribution = $(this).attr('contribution');
                let project      = $(this).attr('project');
                let employee     = $(this).attr('employee');
                $.ajax({
                    type: 'GET',
                    url: "{{ url('/check-project-employee-contributions-status') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        project  : project,
                        employee : employee
                    },
                    success: function(data) {
                        if(data.msg == 'success'){
                            console.log(data.contribution.emp_contribution.unique_id);
                            if(data.contribution.remaining.remaining > 0 && data.contribution.remaining.remaining < 100) {
                                $('.remaing_contribution').empty();
                                $('.remaing_contribution').html("Contribution ("+data.contribution.remaining.remaining+"%) Remaining For This Project");
                                $('.remaing_contribution').css('color', 'red');
                            } else if(data.contribution.remaining.remaining == 0) {
                                $('.remaing_contribution').empty();
                                $('.remaing_contribution').html("Contribution ("+data.contribution.remaining.remaining+"%) Remaining For This Project");
                                $('.remaing_contribution').css('color', 'red');
                            }
                            $('.contribution_form').val(data.contribution.emp_contribution.contribution);
                            $('.unique_key_form').val(data.contribution.emp_contribution.unique_key);
                            $('.project_id_form').val(data.contribution.emp_contribution.project_id);
                            $('.emp_id_form').val(data.contribution.emp_contribution.emp_id);
                            $('.modal-title').html("'"+data.contribution.emp_contribution.emp_name+ "' contribution on '"+ data.contribution.emp_contribution.project_name+"'");
                        }
                    }
                });
            });

            $(document).on('click', '.update_contribution', function(){
                let uniqueKey    = $('.unique_key_form').val();
                let projectId    = $('.project_id_form').val();
                let empId        = $('.emp_id_form').val();
                let contribution = parseInt($('.contribution_form').val());

                $.ajax({
                    type: 'PATCH',
                    url: "{{ url('/contributions/update') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        unique_key   : uniqueKey,
                        project_id   : projectId,
                        emp_id       : empId,
                        contribution : contribution
                    },
                    success: function(data) {
                        if(data.msg == 'success'){
                            $('.contribution_modal').modal('toggle');
                            location.reload();
                            swal("Thank You!", "We have got your message.", "success");
                        }else{
                            swal("Invalid Input", "Please check remaining contribution", "warning");
                        }
                    }
                });
            });
        });
    </script>

@endsection
