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
        <form action="{{ url('/clients/' . $client->id) }}" method="post" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            @csrf
            <fieldset>
                <legend><span class="number"><i class="fas fa-plus"></i></span> Edit Client ({{ $client->id }})</legend>
            </fieldset>
            <fieldset>
                @include ('admin.clients.form', ['formMode' => 'edit'])
            </fieldset>
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