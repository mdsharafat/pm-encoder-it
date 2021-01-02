@extends('layouts.admin.master-layout')

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

    <div class="form-style-5">
        <form action="{{ url('/involvement/store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <fieldset>
                <legend><span class="number"><i class="fas fa-plus"></i></span> Add Involvement</legend>
            </fieldset>
            <fieldset>
                <div class="row">
                    <div class="col-md-4">
                        <label for="project_id">Project</label>
                        <select id="project_id" name="project_id" class="project_id">
                            <option value="" disabled selected>Select Project</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->unique_key }}" >{{ Str::limit($project->title, 50) }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('project_id', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="col-md-4">
                        <label for="project_id">Employee</label>
                        <select required id="emp_id" name="emp_id" class="emp_id">
                            <option value="" disabled selected>Select Employee</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" >{{ Str::limit($employee->full_name, 50) }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('emp_id', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="col-md-4">
                        <label for="project_id">Add Involvement</label>
                        <button type="submit" class="customButton add_contribution">{{ 'Create' }}</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
@endsection
@section('footer-script')
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('change', '.project_id', function(){
                let id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: "{{ url('/available-employee-project/') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id  : id
                    },
                    success: function(data) {
                        if(data.msg == 'success' && data.available_employees != null){
                            $('.emp_id').find('option').remove();
                            $('.emp_id').append('<option value="" disabled default selected>Select Employee</option>');
                            data.available_employees.forEach(function(employee) {
                                $('.emp_id').append('<option value="'+employee.id+'">'+employee.full_name+'</option>');
                            });
                        }else {
                            swal("Error", "No employee available.", "warning");
                        }
                    }
                });
            });
        });
    </script>

@endsection
