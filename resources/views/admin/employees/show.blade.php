@extends('layouts.admin.master-layout')

@section('header-script')
<link href="{{ asset('assets/css/custom-show-details.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
<link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('main-content')
    <div class="container emp-profile">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    @if($employee->image)
                        <img src="{{ asset('storage/employees/'.$employee->image) }}" alt="$employee->full_name"/>
                    @else
                        <img id="blah" class="uploaded-img-preview" src="{{ asset('assets/img/user.jpg') }}" alt="{{ $employee->full_name }}" />
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5>
                        {{ $employee->full_name }}
                    </h5>
                    <h6>
                        {{ $employee->designation->name }}
                    </h6>
                    <h6>
                        {{ $employee->department->name }}
                    </h6>
                    <p class="proile-rating font-weight-bold">{{ $employee->averageReview() }} <span class="text-warning"><i class="fas fa-star"></i></span></p>
                </div>
            </div>
            <div class="col-md-2">
                <a href="{{ url('/employees/' . $employee->id . '/edit') }}">
                    <button type="button" class="customButton" name="btnAddMore">Edit Profile</button>
                </a>
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
                            <a class="nav-link" id="company-profile-tab" data-toggle="tab" href="#company-profile" role="tab" aria-controls="company-profile" aria-selected="false">Company Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="certificate-tab" data-toggle="tab" href="#certificate" role="tab" aria-controls="certificate" aria-selected="false">Certificates</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="project-tab" data-toggle="tab" href="#project" role="tab" aria-controls="project" aria-selected="false">Projects</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                        <table>
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">Username</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ $employee->user->name }}</p></td>
                            </tr>
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">Full Name</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ ucfirst($employee->full_name) }}</p></td>
                            </tr>
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">Official Email</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ $employee->user->email }}</p></td>
                            </tr>
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">Personal Email</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ $employee->email_personal }}</p></td>
                            </tr>
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">Phone</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ $employee->phone }}</p></td>
                            </tr>
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">National Id Card</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ $employee->nid }}</p></td>
                            </tr>
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">Date Of Birth</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ $employee->date_of_birth }}</p></td>
                            </tr>
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">Marital Status</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ $employee->maritalStatus($employee->marital_status) }}</p></td>
                            </tr>
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">Gender</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ $employee->genderName($employee->gender) }}</p></td>
                            </tr>
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">Present Address</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ $employee->present_address }}</p></td>
                            </tr>
                            <tr>
                                <th style="min-width:150px;"><p class="font-weight-bold">Permanent Address</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ $employee->permanent_address }}</p></td>
                            </tr>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="company-profile" role="tabpanel" aria-labelledby="company-profile-tab">
                        <table>
                            <tr>
                                <th style="min-width:180px;"><p class="font-weight-bold">Job Type</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ $employee->jobTypeName($employee->job_type_id) }}</p></td>
                            </tr>
                            <tr>
                                <th style="min-width:180px;"><p class="font-weight-bold">Job Status</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ $employee->jobStatusName($employee->job_status) }}</p></td>
                            </tr>
                            <tr>
                                <th style="min-width:180px;"><p class="font-weight-bold">Experience</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ $employee->dateOfJoin($employee->date_of_join) }}</p></td>
                            </tr>
                            <tr>
                                <th style="min-width:180px;"><p class="font-weight-bold">Current Salary</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p class="font-weight-bold text-danger">{{ $employee->current_salary." $ /per month" }}</p></td>
                            </tr>
                            <tr>
                                <th style="min-width:180px;"><p class="font-weight-bold">Cumulative Paid</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p class="font-weight-bold text-danger">{{ $employee->cumulativeSalary()." $ till now." }}</p></td>
                            </tr>
                            <tr>
                                <th style="min-width:180px;"><p class="font-weight-bold">Cumulative Leave</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p class="font-weight-bold text-danger">{{ $employee->cumulativeLeave()." Days" }}</p></td>
                            </tr>
                            <tr>
                                <th style="min-width:180px;"><p class="font-weight-bold">Date Of Resign</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ $employee->dateOfResign() }}</p></td>
                            </tr>
                            <tr>
                                <th style="min-width:180px;"><p class="font-weight-bold">Reason Of Resign</p></th>
                                <td style="min-width:20px;"><p>:</p></td>
                                <td><p>{{ $employee->reasonOfResign() }}</p></td>
                            </tr>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="certificate" role="tabpanel" aria-labelledby="certificate-tab">
                        <div class="grid">
                            @foreach($employee->certificates as $certificate)
                                <div class="grid-item">
                                    <a href="{{ asset('storage/certificates/'.$certificate->image) }}" class="image-popup">
                                        <img src="{{ asset('storage/certificates/'.$certificate->image) }}" class="img-responsive" alt="Work">
                                    </a>
                                    <hr>
                                    <div class="para-container">
                                        <p class="text-center font-weight-bold">{{ $certificate->certificate }} from {{ $certificate->institute }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Note</th>
                                        <th>Point</th>
                                        <th>Reviewed By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employee->reviews as $item)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->note }}</td>
                                            <td>{{ $item->point }}</td>
                                            <td>{{ $item->reviewedBy->name }}</td>
                                            <td>
                                                <a href="{{ url('/reviews/' . $item->id . '/edit') }}" title="Edit Employee" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <form method="POST" action="{{ url('/reviews' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Employee" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="project" role="tabpanel" aria-labelledby="project-tab">
                        <h5 class="font-weight-bold">Total Projects : <span class="badge bg-success my-custom-badge">{{ $employee->projects->count() }}</span></h5>
                        <div class="grid">
                            @foreach($employee->projects as $project)
                                <div class="grid-item">
                                    <div class="para-container">
                                        <p class="text-center font-weight-bold">Title :  {{ $project->title }}</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="text-center font-weight-bold">Budget : {{ $project->budget." $" }}</p>
                                            </div>
                                            <div class="col-md-6 float-right">
                                                <p class="text-center font-weight-bold">Status : <span class="badge my-custom-badge @if($project->status == 1 ) {{ 'bg-success' }} @else {{ 'bg-danger' }} @endif"> {{ $project->statusName($project->status) }} </span></p>
                                            </div>
                                        </div>
                                        <p class="text-center font-weight-bold text-success">Contribution : {{ $employee->projectContribution($project->id)." %" }}</p>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $employee->projectContribution($project->id) }}%" aria-valuenow="{{ $employee->projectContribution($project->id) }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-script')
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function() {
            $('#dataTable').DataTable({
                "columnDefs": [
                    { "width": "20px", "targets": 0 },
                    { "width": "200px", "targets": 1 },
                ],
            });
            // MAGNIFIC POPUP
            $('.image-popup').magnificPopup({
                type: 'image',
                removalDelay: 300,
                mainClass: 'mfp-with-zoom',
                gallery: {
                enabled: true
                },
                zoom: {
                enabled: true, // By default it's false, so don't forget to enable it

                duration: 300, // duration of the effect, in milliseconds
                easing: 'ease-in-out', // CSS transition easing function

                // The "opener" function should return the element from which popup will be zoomed in
                // and to which popup will be scaled down
                // By defailt it looks for an image tag:
                opener: function (openerElement) {
                    // openerElement is the element on which popup was initialized, in this case its <a> tag
                    // you don't need to add "opener" option if this code matches your needs, it's defailt one.
                    return openerElement.is('img') ? openerElement : openerElement.find('img');
                }
                }
            });
        });
</script>
@endsection