@extends('layouts.admin.master-layout')

@section('header-script')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/datetimepicker/jquery.datetimepicker.min.css') }}"/>
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
        <form action="{{ url('/tasks/' . $task->id) }}" method="post" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            @csrf
            <fieldset>
                <legend><span class="number"><i class="fas fa-plus"></i></span> Edit Task ({{ Str::limit($task->task, 30) }})</legend>
            </fieldset>
            <fieldset>
                @include ('admin.tasks.form', ['formMode' => 'edit'])
            </fieldset>
        </form>
    </div>
@endsection

@section('footer-script')
	<script src="{{ asset('assets/datetimepicker/jquery.datetimepicker.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.datetimepicker').datetimepicker({
                format:'m/d/Y H:i',
            });
        });
    </script>
@endsection
