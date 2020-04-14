@extends('layouts.admin.master-layout')

@section('header-script')
    <link href="{{ asset('assets/css/custom-show-project.css') }}" rel="stylesheet">
@endsection

@section('main-content')
    <div class="form-style-5" style="padding-top: 0px; padding-bottom: 0px;">
        <fieldset>
            <legend><span class="number"><i class="fas fa-table"></i></span> Details 0f Projects {{ $project->title }}</legend>
        </fieldset>
    </div>
    <div class="container">
        <table>
            <tr>
                <td colspan="3">
                    <div class="name">{{ $project->title }}</div>
                </td>
            </tr>
            <tr>
                <td class="details-td">
                    <div class="label">Client</div> : <div class="phone">{{ $project->client->name }}</div>
                    <br><br><div class="label">Platform</div> : <div class="mobile">{{ $project->platform->name }}</div>
                    <br><br><div class="label">Status</div> : <div class="email text-success">{{ $project->projectStatus->name }}</div>
                    <br><br><div class="label">Deadline</div> : <div class="email text-danger font-weight-bold">{{ $project->deadline }}</div>
                    <br><br><div class="label">Budget</div> : <div class="mobile">{{ $project->budget." $" }}</div>
                    <br><br><div class="label">Client Feedback</div> : <div class="mobile">@if($project->feedback_from_client)<span class="text-warning"><i class="fas fa-star"></i></span> @endif{{ $project->feedback_from_client }}</div>
                    <br><br><div class="label">Our Feedback</div> : <div class="mobile">@if($project->feedback_to_client)<span class="text-warning"><i class="fas fa-star"></i></span> @endif{{ $project->feedback_to_client }}</div>
                    <br><br><div class="label">Payment Status</div> :
                        <div class="mobile">
                            @if($project->payment_status == 1)
                                {{ 'Pending' }}
                            @elseif($project->payment_status == 2)
                                {{ 'Partially Paid' }}
                            @elseif($project->payment_status == 3)
                                {{ 'Full Paid' }}
                            @else
                                {{ '' }}
                            @endif
                        </div>
                    <br><br><div class="label">Payment Received</div> : <div class="mobile">{{ $project->payment_received." $" }}</div>
                </td>
                <td class="description-td">
                    <a href="{{ url('/projects/'.$project->id.'/edit') }}" title="Edit Project" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                    <a href="{{ url('/projects/'.$project->id.'/edit') }}" title="Edit Project" class="btn btn-success btn-sm"><i class="fas fa-user"></i> Developers</a>
                    <a href="{{ url('/projects/'.$project->id.'/edit') }}" title="Edit Project" class="btn btn-info btn-sm"><i class="fas fa-tasks"></i></i> Task List</a>
                    <br>
                    <br>
                    <div class="description" spellcheck="false">{{ $project->desc }}</div>
                    <br>
                    <div class="label">Git</div>
                    <div class="description" spellcheck="false">{{ $project->git_repo }}</div>

                    <br>
                    <div class="label">Trello</div>
                    <div class="description" spellcheck="false">{{ $project->trello_link }}</div>

                    <br>
                    <div class="label">Google Drive</div>
                    <div class="description" spellcheck="false">{{ $project->gd_link }}</div>

                    <br>
                    <div class="label">Demo Website</div>
                    <div class="description" spellcheck="false">{{ $project->demo_web_link }}</div>

                    <br>
                    <div class="label">Live Project</div>
                    <div class="description" spellcheck="false">{{ $project->live_project_link }}</div>
                </td>
            </tr>
        </table>
    </div>
    
@endsection

@section('footer-script')
    <script>

    </script>
@endsection
