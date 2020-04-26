@extends('layouts.admin.master-layout')

@section('header-script')
<link href="{{ asset('assets/css/custom-show-project.css') }}" rel="stylesheet">
@endsection

@section('main-content')
    <div class="container emp-profile" style="margin-top: 0px; margin-bottom: 0px;">
        <div class="row">
            <div class="col-md-10">
                <div class="profile-head">
                    <div class="name">{{ $project->title }}</div>
                </div>
            </div>
            <div class="col-md-2">
                @role('Admin')
                    <a href="{{ url('/projects/' . $project->id . '/edit') }}">
                        <button type="button" class="customButton" name="btnAddMore">Edit Project</button>
                    </a>
                @endrole
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="profile-head">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="link-tab" data-toggle="tab" href="#link" role="tab" aria-controls="link" aria-selected="true">Links</a>
                        </li>
                        @role('Admin')
                        <li class="nav-item">
                            <a class="nav-link" id="developer-tab" data-toggle="tab" href="#developer" role="tab" aria-controls="developer" aria-selected="false">Developers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tasks-tab" data-toggle="tab" href="#tasks" role="tab" aria-controls="tasks" aria-selected="false">Tasks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="tasks" aria-selected="false">Payments</a>
                        </li>
                        @endrole
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                        <table>
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">% of Completion</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p class="font-weight-bold text-success">{{ number_format($project->percentageOfCompletion(), 2) }} % </p></td>
                            </tr>
                            @role('Admin')
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">Deadline</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ $project->deadline }}</p></td>
                            </tr>
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">Budget</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ $project->budget." $" }}</p></td>
                            </tr>
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">Cient Name</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ $project->client->name }}</p></td>
                            </tr>
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">Platform</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ $project->platform->name }}</p></td>
                            </tr>
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">Client Feedback</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ $project->feedback_from_client }} <span class="text-warning" style="font-size:14px;"><i class="fas fa-star"></i></span></p></td>
                            </tr>
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">Our Feedback</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ $project->feedback_to_client }} <span class="text-warning" style="font-size:14px;"><i class="fas fa-star"></i></span></p></td>
                            </tr>
                            @endrole
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">Status</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ $project->statusName($project->status) }}</p></td>
                            </tr>
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">Description</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ $project->desc }}</p></td>
                            </tr>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="link" role="tabpanel" aria-labelledby="link-tab">
                        <table>
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">Github</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><a target="__blank" class="link_a_tag" href="{{ $project->git_repo }}">{{ $project->git_repo }}</a></td>
                            </tr>
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">Trello</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><a target="__blank" class="link_a_tag" href="{{ $project->trello_link }}">{{ $project->trello_link }}</a></td>
                            </tr>
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">Google Drive</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><a target="__blank" class="link_a_tag" href="{{ $project->gd_link }}">{{ $project->gd_link }}</a></td>
                            </tr>
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">Demo Web Link</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><a target="__blank" class="link_a_tag" href="{{ $project->demo_web_link }}">{{ $project->demo_web_link }}</a></td>
                            </tr>
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">Live Project Link</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><a target="__blank" class="link_a_tag" href="{{ $project->live_project_link }}">{{ $project->live_project_link }}</a></td>
                            </tr>
                        </table>
                    </div>
                    @role('Admin')
                    <div class="tab-pane fade" id="developer" role="tabpanel" aria-labelledby="developer-tab">
                        @foreach ($project->tasks()->groupBy('assigned_to')->get() as $task )
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-4">
                                        @if($task->assignedTo->image)
                                            <img src="{{ asset('storage/clients/'.$task->assignedTo->image) }}" alt="{{ $task->assignedTo->full_name }}" style="width:100px; height: 100px; margin: 0 auto; border-radius: 50%; border: 1px solid #cecece;">
                                        @else
                                            <img src="{{ asset('assets/img/user.jpg') }}" alt="{{ $task->assignedTo->full_name }}" style="width:100px; height: 100px; margin: 0 auto; border-radius: 50%; border: 1px solid #cecece;">
                                        @endif
                                    </div>
                                    <div class="col-md-8 text-left">
                                        <h1 class="text-success" style="font-size: 20px; margin-top: 10px; font-weight: bold;">{{ "Name : ".$task->assignedTo->full_name }}</h1>
                                        <p class="title">Department : {{ $task->assignedTo->department->name }} </p>
                                        <p class="title">Designation: {{ $task->assignedTo->designation->name }} </p>
                                        <p class="title">Contribution : {{ $project->projectContribution($task->assignedTo->id) }}</p>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="tasks-tab">
                        <div class="grid">
                            @foreach ($project->tasks as $task)
                                <div class="grid-item custom_task_grid">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p class="font-weight-bold">Assigned To: {{ $task->assignedTo->full_name }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="float-right"> <span class="badge my-custom-badge @if($task->status == 1 ) {{ 'bg-primary' }} @elseif($task->status ==2) {{ 'bg-danger' }} @elseif($task->status == 3) {{ 'bg-info' }} @elseif($task->status ==4) {{ 'bg-warning' }} @else {{ 'bg-success' }} @endif"> {{ $task->statusName($task->status) }} </span></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>{{ $task->task }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                        <table>
                            @foreach ($project->credits as $credit)
                                <tr>
                                    <th style="min-width:100px;"><p class="font-weight-bold">Date</p></th>
                                    <td style="min-width:20px;"><p>:</p></td>
                                    <td><p>{{ $credit->date }}</p></td>
                                    <td style="min-width:20px;"><p></p></td>
                                    <td style="min-width:20px;"><p></p></td>
                                    <td style="min-width:20px;"><p></p></td>
                                    <th style="min-width:150px;"><p class="font-weight-bold">Received Amount</p></th>
                                    <td style="min-width:20px;"><p>:</p></td>
                                    <td style="min-width:20px;"><p>{{ $credit->amount." $" }}</p></td>
                                </tr>
                            @endforeach
                            <tr style="border-top: 1px solid #858796; padding-top: 10px !important;">
                                <th style="min-width:100px;"><p class="font-weight-bold"></p></th>
                                <td style="min-width:20px;"><p></p></td>
                                <td><p></p></td>
                                <td style="min-width:20px;"><p></p></td>
                                <td style="min-width:20px;"><p></p></td>
                                <td style="min-width:20px;"><p></p></td>
                                <th style="min-width:150px;"><p class="font-weight-bold">Total</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td style="min-width:20px;"><p>{{ $project->credits->sum('amount')." $" }}</p></td>
                            </tr>
                        </table>
                    </div>
                    @endrole
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-script')

@endsection