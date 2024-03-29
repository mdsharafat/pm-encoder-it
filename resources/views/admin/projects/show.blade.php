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
                            <a class="nav-link" id="involvement-tab" data-toggle="tab" href="#involvement" role="tab" aria-controls="involvement" aria-selected="false">Involvement</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contribution-tab" data-toggle="tab" href="#contribution" role="tab" aria-controls="contribution" aria-selected="false">Contribution</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="note-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="false">Notes</a>
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
                                <td><p class="font-weight-bold text-success"> % </p></td>
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
                    <div class="tab-pane fade" id="involvement" role="tabpanel" aria-labelledby="involvement-tab">
                        @foreach($project->employees as $employee)
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-3">
                                        @if($employee->user->image)
                                            <img src="{{ asset('storage/employees/'.$employee->user->image) }}" alt="" style="width:150px; height: 150px; margin: 0 auto; border: 1px solid #cecece;">
                                        @else
                                            <img src="{{ asset('assets/img/user.jpg') }}" alt="" style="width:150px; height: 150px; margin: 0 auto; border: 1px solid #cecece;">
                                        @endif
                                    </div>
                                    <div class="col-md-9 text-left">
                                        <h1 class="text-success" style="font-size: 20px; margin-top: 10px; font-weight: bold;">{{ "Name : ". $employee->full_name }}</h1>
                                        <p class="title">Department : {{ $employee->department->name }} </p>
                                        <p class="title">Designation: {{ $employee->designation->name }} </p>
                                        <p class="title">Ratings: {{ $employee->averageReview() }} </p>

                                        @if(($employee->currentlyInvolvedProjects($employee->id) - 1) >= 0)
                                            <p class="title" style="color: red"> {{ 'Currently involved in '. $employee->currentlyInvolvedProjects($employee->id). ' more project.' }} </p>
                                        @else
                                            <p class="title" style="color: green">   {{ 'Working only this project.' }} </p>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="contribution" role="tabpanel" aria-labelledby="contribution-tab">
                        @foreach($project->contributions as $contribution)
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-4">
                                        @if($contribution->employee->user->image)
                                            <img src="{{ asset('storage/employees/'.$contribution->employee->user->image) }}" alt="" style="width:150px; height: 150px; margin: 0 auto; border: 1px solid #cecece;">
                                        @else
                                            <img src="{{ asset('assets/img/user.jpg') }}" alt="" style="width:150px; height: 150px; margin: 0 auto; border: 1px solid #cecece;">
                                        @endif
                                    </div>
                                    <div class="col-md-8 text-left">
                                        <h1 class="text-success" style="font-size: 20px; margin-top: 10px; font-weight: bold;">{{ "Name : ". $contribution->employee->full_name }}</h1>
                                        <p class="title">Department : {{ $contribution->employee->department->name }} </p>
                                        <p class="title">Designation: {{ $contribution->employee->designation->name }} </p>
                                        <p class="title">Contribution : {{ $contribution->contribution." %" }}</p>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $contribution->contribution }}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab">
                        <div class="grid">
                            @foreach($project->projectNotes as $projectNote)
                                <div class="grid-item custom_task_grid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class=""> <span class="badge my-custom-badge bg-success"> {{ $projectNote->updated_at }} </span></p>
                                            <p class="font-weight-bold">Note : {{ $projectNote->note }}</p>
                                        </div>
                                    </div>
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-12">--}}
{{--                                            <p>{{ "task" }}</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
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
                                    <td style="min-width:20px;"><p>{{ $credit->amount." BDT" }}</p></td>
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
                                <td style="min-width:20px;"><p>{{ $project->credits->sum('amount')." BDT" }}</p></td>
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
