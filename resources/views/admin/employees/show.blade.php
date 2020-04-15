@extends('layouts.admin.master-layout')

@section('header-script')
<link href="{{ asset('assets/css/custom-employee-profile.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
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
                    <p class="proile-rating">Review : <span class="text-warning"><i class="fas fa-star"></i></span></p>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Company Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="certificate-tab" data-toggle="tab" href="#certificate" role="tab" aria-controls="certificate" aria-selected="false">Certificate</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <a href="{{ url('/employees/' . $employee->id . '/edit') }}">
                    <button type="button" class="customButton" name="btnAddMore">Edit Profile</button>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="profile-work">
                    <p class="font-weight-bold">Description</p>
                    <p>{{ $employee->desc }}</p>
                    <hr>
                    <p>RUNNING PROJECTS</p>
                    <a href="">Website Link</a><br/>
                    <a href="">Bootsnipp Profile</a><br/>
                    <a href="">Bootply Profile</a>
                    <hr>
                    <p>SKILLS</p>
                    <a href="">Web Designer</a><br/>
                    <a href="">Web Developer</a><br/>
                    <a href="">WordPress</a><br/>
                    <a href="">WooCommerce</a><br/>
                    <a href="">PHP, .Net</a><br/>
                </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Username</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $employee->user->name }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Full Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ ucfirst($employee->full_name) }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Official Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $employee->user->email }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Personal Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $employee->email_personal }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $employee->phone }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>National Id Card</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $employee->nid }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Date Of Birth</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $employee->date_of_birth }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Marital Status</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            @if($employee->marital_status == 1)
                                            {{ 'Married' }}
                                            @else
                                            {{ 'Unmarried' }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Present Address</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $employee->present_address }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Permanent Address</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $employee->permanent_address }}</p>
                                    </div>
                                </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Job Type</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $employee->jobType->name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Job Status</label>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    @if($employee->job_status == 0)
                                        {{ 'Running' }}
                                    @else
                                        {{ 'Former' }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Experience</label>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    @php
                                        $date_of_join = \Carbon\Carbon::parse($employee->date_of_join);
                                        $now = \Carbon\Carbon::now();
                                        $experience = $date_of_join->diff(\Carbon\Carbon::now())->format("%y years, %m months and %d days");
                                    @endphp

                                    @if($now > $date_of_join)
                                            {{ $experience }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Current Salary</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $employee->current_salary." $ /per month" }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Cumulative Paid</label>
                            </div>
                            <div class="col-md-6">
                                <p></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Cumulative Leave</label>
                            </div>
                            <div class="col-md-6">
                                <p></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Current Month Leave</label>
                            </div>
                            <div class="col-md-6">
                                <p></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Total Projects</label>
                            </div>
                            <div class="col-md-6">
                                <p></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Date Of Resign</label>
                            </div>
                            <div class="col-md-6">
                                <p>Not Applicable</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Reason Of Resign</label>
                            </div>
                            <div class="col-md-6">
                                <p>Not Applicable</p>
                            </div>
                        </div>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-script')
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script>
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
</script>
@endsection