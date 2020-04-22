@extends('layouts.admin.master-layout')

@section('header-script')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
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

    <div class="form-style-5">
        <form action="{{ url('/salary-expenses/' . $salaryExpense->id) }}" method="post" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            @csrf
            <fieldset>
                <legend><span class="number"><i class="fas fa-plus"></i></span> Edit Salary Expense ({{ $salaryExpense->employee->full_name }})</legend>
            </fieldset>
            <fieldset>
                @include ('admin.salary-expenses.form', ['formMode' => 'edit'])
            </fieldset>
        </form>
    </div>
@endsection

@section('footer-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script>
        $(document).ready(function(){
            $(function () {
                $("#datepicker").datepicker({
                        autoclose: true,
                        format: 'mm/dd/yyyy'
                });
            });
        });
    </script>
@endsection