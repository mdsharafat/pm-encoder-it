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
        <form action="{{ url('/task-statuses') }}" method="post" enctype="multipart/form-data">
            @csrf
            <fieldset>
                <legend><span class="number"><i class="fas fa-plus"></i></span> Add New Task Status</legend>
            </fieldset>
            <fieldset>
                @include ('admin.task-statuses.form', ['formMode' => 'create'])
            </fieldset>
        </form>
    </div>
@endsection
