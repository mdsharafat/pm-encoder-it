@extends('layouts.admin.master-layout')

@section('header-script')
<style>
.card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    max-width: 968px;
    margin: auto;
    text-align: center;
    font-family: arial;
    padding: 20px;
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

    <div class="card">
        <div class="row">
            <div class="col-md-4">
                @if($task->assignedTo->image)
                    <img src="{{ asset('storage/clients/'.$task->assignedTo->image) }}" alt="{{ $task->assignedTo->full_name }}" style="width:150px; height: 150px; margin: 0 auto; border-radius: 50%; border: 1px solid #cecece;">
                @else
                    <img src="{{ asset('assets/img/user.jpg') }}" alt="{{ $task->assignedTo->full_name }}" style="width:150px; height: 150px; margin: 0 auto; border-radius: 50%; border: 1px solid #cecece;">
                @endif
            </div>
            <div class="col-md-8 text-left">
                <h1 class="text-success" style="font-size: 20px; margin-top: 10px; font-weight: bold;">{{ "Assigned To ".$task->assignedTo->full_name }}</h1>
                <p class="title">Status: <span class="badge my-custom-badge @if($task->status ==1 ) {{ 'bg-primary' }} @elseif($task->status ==2) {{ 'bg-danger' }} @elseif($task->status ==3) {{ 'bg-info' }} @else {{ 'bg-success' }} @endif"> {{ $task->statusName($task->status) }} </span></p>
                <p class="title">Project: {{ ucfirst($task->project->title) }}</p>
                @role('Super Admin')
                <p class="title">Total Point: {{ $task->total_point }}</p>
                <p class="title">Received Point: {{ $task->received_point }}</p>
                @endrole
            </div>
        </div>
        <p class="text-justify" style="margin-top: 10px;">{{ $task->task }}</p>
        @can('update-task')
            <a class="btn btn-sm btn-primary client_edit_show_page" href="{{ url('/tasks/' . $task->id.'/edit') }}" title="Edit Task" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
        @endcan
    </div>
@endsection

@section('footer-script')

@endsection