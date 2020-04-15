<div class="row">
    <div class="col-md-4">
        <label for="name" class="control-label">{{ 'User Name' }}</label>
        <input required type="text" name="name" id="name" placeholder="User Name *" value="{{ isset($employee->user->name) ? $employee->user->name : old('name')}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-4">
        <label for="email" class="control-label">{{ 'User Email' }}</label>
        <input required type="email" name="email" id="email" placeholder="Email (official) *" value="{{ isset($employee->user->email) ? $employee->user->email : old('email')}}" >
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-4">
        <label for="full_name" class="control-label">{{ 'Full Name' }}</label>
        <input required type="text" name="full_name" id="full_name" placeholder="Full Name *" value="{{ isset($employee->full_name) ? $employee->full_name : old('full_name')}}" >
        {!! $errors->first('full_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <label for="email_personal" class="control-label">{{ 'Personal Email' }}</label>
        <input type="email" name="email_personal" id="email_personal" placeholder="Email (personal)" value="{{ isset($employee->email_personal) ? $employee->email_personal : old('email_personal')}}" >
        {!! $errors->first('email_personal', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-4">
        <label>Date Of Join </label>
        <div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
            <input required type="text" name="date_of_join" value="{{ isset($employee->date_of_join) ? \Carbon\Carbon::parse($employee->date_of_join)->format("m/d/Y") : old('date_of_join')}}" readonly />
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
        </div>
        {!! $errors->first('date_of_join', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-4">
        <label for="phone" class="control-label">{{ 'Phone' }}</label>
        <input required type="text" name="phone" id="phone" placeholder="Phone *" value="{{ isset($employee->phone) ? $employee->phone : old('phone')}}" >
        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <label for="department_id">Department</label>
        <select required id="department_id" name="department_id">
            @foreach($departments as $department)
                <option value="{{ $department->id }}" @if($employee->department_id == $department->id) {{ 'selected' }} @endif>{{ $department->name }}</option>
            @endforeach
        </select>
        {!! $errors->first('department_id', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-4">
        <label for="designation_id">Designation</label>
        <select required id="designation_id" name="designation_id">
            @foreach($designations as $designation)
                <option value="{{ $designation->id }}" @if($employee->designation_id == $designation->id) {{ 'selected' }} @endif>{{ $designation->name }}</option>
            @endforeach
        </select>
        {!! $errors->first('designation_id', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-4">
        <label for="job_type_id">Job Type</label>
        <select required id="job_type_id" name="job_type_id">
            @foreach($jobTypes as $jobType)
                <option value="{{ $jobType->id }}" @if($employee->job_type_id == $jobType->id) {{ 'selected' }} @endif>{{ $jobType->name }}</option>
            @endforeach
        </select>
        {!! $errors->first('job_type_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <label for="nid" class="control-label">{{ 'National ID' }}</label>
        <input type="text" name="nid" id="nid" placeholder="NID" value="{{ isset($employee->nid) ? $employee->nid : old('nid')}}" >
        {!! $errors->first('nid', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-4">
        <label>Date Of Birth </label>
        <div id="datepicker2" class="input-group date" data-date-format="mm-dd-yyyy">
            <input type="text" name="date_of_birth" value="{{ isset($employee->date_of_birth) ? \Carbon\Carbon::parse($employee->date_of_birth)->format("m/d/Y") : old('date_of_birth')}}" readonly />
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
        </div>
        {!! $errors->first('date_of_birth', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-4">
        <label for="marital_status">Marital Status</label>
        <select required id="marital_status" name="marital_status" required>
            <option value="0" @if($employee->marital_status == 0) {{ 'selected' }} @endif>{{ "Unmarried" }}</option>
            <option value="1" @if($employee->marital_status == 1) {{ 'selected' }} @endif>{{ "Married" }}</option>
        </select>
        {!! $errors->first('marital_status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <label for="present_address" class="control-label">{{ 'Present Address' }}</label>
        <input type="text" name="present_address" id="present_address" placeholder="Present Address" value="{{ isset($employee->present_address) ? $employee->present_address : old('present_address')}}" >
        {!! $errors->first('present_address', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-4">
        <label for="permanent_address" class="control-label">{{ 'Permanent Address' }}</label>
        <input type="text" name="permanent_address" id="permanent_address" placeholder="Permanent Address" value="{{ isset($employee->permanent_address) ? $employee->permanent_address : old('permanent_address')}}" >
        {!! $errors->first('permanent_address', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-4">
        <label for="current_salary" class="control-label">{{ 'Current Salary ($)' }}</label>
        <input required type="number" name="current_salary" id="current_salary" placeholder="Current Salary Must be in $*" value="{{ isset($employee->current_salary) ? $employee->current_salary : 0 }}" >
        {!! $errors->first('current_salary', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <label for="desc" class="control-label">{{ 'Description' }}</label>
        <textarea class="form-control" rows="5" name="desc" type="textarea" id="desc" >{{ isset($employee->desc) ? $employee->desc : ''}}</textarea>
        {!! $errors->first('desc', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <label for="image" class="control-label">{{ 'Image' }}</label>
        <div class='file-input'>
            <input type='file' name="image" onchange="readURL(this);">
            <span class='button'>Choose</span>
            <span class='label' data-js-label>No file selected</label>
            <script>
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
        </div>
    </div>
    <div class="col-md-6 mg-t-30">
        @if($employee->image)
        <img id="blah" class="uploaded-img-preview" src="{{ asset('storage/employees/'.$employee->image) }}"
            alt="{{ $employee->image }}" />
        @else
        <img id="blah" class="uploaded-img-preview" src="{{ asset('assets/img/user.jpg') }}" alt="{{ $employee->full_name }}" />
        @endif
    </div>
</div>

<fieldset class="mg-t-30">
    <legend><span class="number"><i class="fas fa-plus"></i></span> Add Certificates </legend>
</fieldset>
<div class="row">
    <div class="col-md-12 text-center">
        <button type="button" class="btn btn-success btn-sm add_certificate_button" style="background: green; width:60px; height: 60px; border-radius: 50% !important; margin-bottom: 20px;"><i class="fas fa-plus"></i></button>
    </div>
</div>

<div class="add_certificate_div">
    @if($employee->certificates->count() > 0)
        @foreach($employee->certificates as $certificate)
            <input type="hidden" class="certificate_id_{{ $loop->iteration }}" value="{{ $certificate->id }}" />
            <div class="row certificate_row_{{ $loop->iteration }}">
                <div class="col-md-3">
                    <label for="institute" class="control-label">{{ 'Institute' }}</label>
                    <input required type="text" id="institute" placeholder="Institute *" value="{{ $certificate->institute }}" >
                    {!! $errors->first('institute', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="col-md-3">
                    <label for="certificate" class="control-label">{{ 'Certificate' }}</label>
                    <input required type="text" id="certificate" placeholder="Name Of Certificate *" value="{{ $certificate->certificate }}" >
                    {!! $errors->first('certificate', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="col-md-3">
                    <label for="cert_image" class="control-label">{{ 'Certificate Image' }}</label>
                    <input type="file" id="cert_image" style="width: 100%; background: #ffffff; padding: 7px; border: 1px solid #cecece;">
                    {!! $errors->first('cert_image', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="col-md-2">
                    <label class="control-label">{{ 'Old Image' }}</label>
                    <img style="width: 43px; height: 43px; display: block; overflow: hidden;"  src="{{ asset('storage/certificates/'.$certificate->image) }}" />
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-success btn-sm delete_certificate_button" del-row-attr="{{ $loop->iteration }}" style="background: red; border-width: 0px; width:40px; height: 40px; border-radius: 50% !important; margin-top: 35px;"><i class="fas fa-minus"></i></button>
                </div>
            </div>
        @endforeach
    @endif
</div>

<div class="row">
    <div class="col-md-12 mg-t-30">
        <button type="submit" class="customButton">{{ $formMode === 'edit' ? 'Update' : 'Create' }}</button>
    </div>
</div>