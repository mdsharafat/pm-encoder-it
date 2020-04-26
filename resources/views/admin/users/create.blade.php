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
        <form action="{{ url('/users') }}" method="post">
            @csrf
            <fieldset>
                <legend><span class="number"><i class="fas fa-plus"></i></span> Add User</legend>
            </fieldset>
            <fieldset>
                <div class="row">
                    <div class="col-md-6">
                        <label>Name</label>
                        <input type="text" name="name" placeholder="User Name *" required value="{{ old('name') }}">
                    </div>
                    <div class="col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="User Email *" required value="{{ old('email') }}">
                    </div>
                </div>
            </fieldset>
            <button type="submit" class="customButton">Submit</button>
        </form>
    </div>
@endsection