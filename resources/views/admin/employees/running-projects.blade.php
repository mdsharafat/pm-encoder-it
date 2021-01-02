@extends('layouts.admin.master-layout')

@section('header-script')
<style>
.card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    max-width: 100%;
    text-align: center;
    font-family: arial;
    padding: 20px;
    margin-bottom: 20px;
}

.title {
  color: grey;
  font-size: 14px;
  font-weight: bold;
  margin-top: 5px;
  margin-bottom: 0px;
}

.client_edit_show_page {
    max-width: 40px;
    display: inline-block;
}
</style>
@endsection

@section('main-content')
    <div class="container">
        <div class="form-style-5" style="padding-top: 0px; padding-bottom: 0px;">
            <fieldset>
                <legend><span class="number"><i class="fas fa-table"></i></span> Running projects of <span class="font-weight-bold">{{ $employee->full_name }}</span></legend>
            </fieldset>
        </div>
        @foreach($runningProjects as $runningProject)
            <div class="card">
                <div class="row">
                    <div class="col-md-4">
                        @if($runningProject->image)
                            <img src="{{ asset('storage/employees/'.$runningProject->image) }}" alt="{{ $runningProject->name }}" style="width: 100px; height: 100px; margin: 0 auto; border: 1px solid #cecece;">
                        @else
                            <img src="{{ asset('assets/img/user.jpg') }}" alt="{{ $runningProject->name }}" style="width: 100px; height: 100px; margin: 0 auto; border: 1px solid #cecece;">
                        @endif
                    </div>
                    <div class="col-md-8 text-left">
                        <h1 class="text-success" style="font-size: 20px; margin-top: 10px; font-weight: bold;">{{ "Title : ".$runningProject->title }}</h1>
                        <p class="title">Budget : {{ $runningProject->budget }} </p>
                        <p class="title">Deadline: {{ Carbon\Carbon::parse($runningProject->deadline)->format('D jS F, Y') }} </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('footer-script')

@endsection
