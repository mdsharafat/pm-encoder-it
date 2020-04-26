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
        <form action="{{ url('/users/'.$user->id) }}" method="post">
            {{ method_field('PATCH') }}
            @csrf
            <fieldset>
                <legend><span class="number"><i class="fas fa-plus"></i></span> Edit User ({{ $user->name }})</legend>
            </fieldset>
            <fieldset>
                <div class="row">
                    <div class="col-md-4">
                        <label>Name</label>
                        <input type="text" name="name" placeholder="User Name *" required value="{{ $user->name }}">
                    </div>
                    <div class="col-md-4">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="User Email *" required value="{{ $user->email }}">
                    </div>
                    @role('Admin')
                        <div class="col-md-4">
                            <label>Role</label>
                            <select id="role" name="role" required>
                                <option disabled selected>Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" @if($user->getRoleNames()->first() == $role->name) {{ 'selected' }} @endif>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endrole
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label class="checkbox_container" style="margin-bottom: 30px;">Active
                            <input type="checkbox" name="status" @if($user->status == 1) {{ 'checked' }} @endif>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </fieldset>
            <button type="submit" class="customButton">Submit</button>
        </form>
    </div>
@endsection