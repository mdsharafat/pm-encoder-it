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
        <form action="{{ url('/contributions') }}" method="post" enctype="multipart/form-data">
            @csrf
            <fieldset>
                <legend><span class="number"><i class="fas fa-plus"></i></span> Add Contribution</legend>
            </fieldset>
            <fieldset>
                @include ('admin.contributions.form', ['formMode' => 'create'])
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
                    url: "{{ url('/check-project-total-contributions-status') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id  : id
                    },
                    success: function(data) {
                        if(data.msg == 'success'){
                            if(data.remaining.remaining > 0 && data.remaining.remaining < 100) {
                                console.log(data.remaining.remaining);
                                $('.remaing_contribution').html("Contribution ("+data.remaining.remaining+"%) Remaining");
                                $('.remaing_contribution').css('color', 'red');
                                $('.emp_id').find('option').remove();
                                $('.emp_id').append('<option value="" disabled default selected>Select Employee</option>');
                                data.employees.forEach(function(employee) {
                                    $('.emp_id').append('<option value="'+employee.id+'">'+employee.full_name+'</option>');
                                });
                            }else if (data.remaining.remaining == null){
                                console.log(data.remaining.remaining);
                                $('.remaing_contribution').html("Contribution (%)");
                                $('.remaing_contribution').css('color', '#858796');
                            }else if(data.remaining.remaining <= 0) {
                                console.log(data.remaining.remaining);
                                $('.remaing_contribution').html("No Contribution remains for this project");
                                $('.remaing_contribution').css('color', 'red');
                            }
                        }
                    }
                });
            });
        });
    </script>

@endsection
