@extends('layouts.admin.master-layout')

@section('header-script')
<style>
.form-group {
  display: block;
  margin-bottom: 15px;
}

.form-group input {
  padding: 0;
  height: initial;
  width: initial;
  margin-bottom: 0;
  display: none;
  cursor: pointer;
}

.form-group label {
  position: relative;
  cursor: pointer;
}

.form-group label:before {
  content:'';
  -webkit-appearance: none;
  background-color: transparent;
  border: 2px solid #0079bf;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
  padding: 10px;
  display: inline-block;
  position: relative;
  vertical-align: middle;
  cursor: pointer;
  margin-right: 5px;
}

.form-group input:checked + label:after {
  content: '';
  display: block;
  position: absolute;
  top: 2px;
  left: 9px;
  width: 7px;
    height: 16px;
    border: solid green;
    border-width: 0 3px 4px 0;
  transform: rotate(45deg);
}
</style>
@endsection

@section('main-content')
    <div class="form-style-5">
        <form action="{{ url('/permission-management') }}" method="post" enctype="multipart/form-data">
            @csrf
            <fieldset>
                <legend><span class="number"><i class="fas fa-plus"></i></span> Permission Management</legend>
            </fieldset>
            <fieldset>
                <div class="row">
                    <div class="col-md-3">
                        <div class="user_img_div" style="width: 100%; display: block; overflow: hidden;">
                            @if($user->employee->image != null)
                                <img style="width: 100px; height: 100px; display: block; overflow: hidden; margin: 0 auto;" src="{{ asset('storage/users/'.$user->employee->image) }}" alt="image">
                            @else
                                <img style="width: 100px; height: 100px; display: block; overflow: hidden; margin: 0 auto; border: 1px solid #cecece;" src="{{ asset('assets/img/user.jpg') }}" alt="image">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-9 text-left">
                        <label for="user_id" class="control-label"><strong>{{ 'User Name : '.$user->name }} <br> {{ 'Employee Name : '.$user->employee->full_name }} <br> {{ 'Department : '.$user->employee->department->name }} <br> {{ 'Designation : '.$user->employee->designation->name }}</strong></label>
                        <input required type="hidden" name="user_id" id="user_id" value="{{ $user->id }}" readonly>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-12" style="margin-bottom: 20px;">
                        <label for="employee"><strong>Permissions <hr></strong></label>
                    </div>
                    @foreach ($permissions as $permission)
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="permission_ids[]" id="{{ $permission->name }}" value="{{ $permission->id }}" @if( in_array($permission->id, $userPermissions)) {{ 'checked' }} @endif>
                                <label for="{{ $permission->name }}">{{ $permission->name }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="customButton mg-t-30">Update</button>
            </fieldset>
        </form>
    </div>
@endsection

@section('footer-script')

@endsection