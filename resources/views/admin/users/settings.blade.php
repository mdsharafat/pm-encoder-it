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
        <form action="{{ url('/change-password') }}" method="post">
            @csrf
            <fieldset>
                <legend><span class="number"><i class="fas fa-unlock-alt"></i></span> Change Password</legend>
            </fieldset>
            <fieldset>
                <div class="row">
                    <div class="col-md-4">
                        <input type="password" name="old_password" placeholder="Old Password *" required>
                    </div>
                    <div class="col-md-4">
                        <input type="password" name="new_password" placeholder="New Password *" required>
                    </div>
                    <div class="col-md-4">
                        <input type="password" name="confirm_new_password" placeholder="Confirm New Password *" required>  
                    </div>
                </div>
            </fieldset>
            <button type="submit" class="customButton">Submit</button>
        </form>
        <br>
        <hr>
        <br>
        <form action="{{ url('/change-user-image') }}" method="post" enctype='multipart/form-data'>
            {{ method_field('PATCH') }}
            @csrf
            <fieldset>
                <legend><span class="number"><i class="fas fa-images"></i></span> Change Profile Picture</legend>
            </fieldset>
            <fieldset>
                <div class="row">
                    <div class="col-md-6">
                        <div class='file-input'>
                            <input required type='file' name="image" onchange="readURL(this);">
                            <span class='button'>Choose</span>
                            <span class='label' data-js-label>No file selected</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if(Auth::user()->image)
                        <img id="blah" class="uploaded-img-preview" src="{{ asset('storage/users/'.Auth::user()->image) }}"
                            alt="{{ Auth::user()->name }}" />
                        @else
                        <img id="blah" class="uploaded-img-preview" src="{{ asset('assets/img/user.jpg') }}" alt="{{ Auth::user()->name }}" />
                        @endif
                    </div>
                </div>
            </fieldset>
            <button type="submit" class="customButton">Submit</button>
        </form>
    </div>
@endsection

@section('footer-script')
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection