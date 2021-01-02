<div class="row">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
            <label for="title" class="control-label">{{ 'Title' }}</label>
            <input required type="text" name="title" id="title" placeholder="Title *" value="{{ isset($project->title) ? $project->title : old('title')}}" >
            {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-4">
        <label for="client_id">Client</label>
        <select required id="client_id" name="client_id">
            <option value="" disabled selected>Select Client</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}" @if($project->client_id == $client->id) {{ 'selected' }} @endif>{{ $client->name }}</option>
            @endforeach
        </select>
        {!! $errors->first('client_id', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('budget') ? 'has-error' : ''}}">
            <label for="budget" class="control-label">{{ 'Budget (BDT)' }}</label>
            <input required type="number" name="budget" id="budget" placeholder="Budget *" value="{{ isset($project->budget) ? $project->budget : old('budget')}}" >
            {!! $errors->first('budget', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <label for="payment_status">Payment Status</label>
        <select id="payment_status" name="payment_status">
            <option value="1" @if($project->payment_status == 1) {{ 'selected' }} @endif>Pending</option>
            <option value="2" @if($project->payment_status == 2) {{ 'selected' }} @endif>Partially Paid</option>
            <option value="3" @if($project->payment_status == 3) {{ 'selected' }} @endif>Full Paid</option>
        </select>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('git_repo') ? 'has-error' : ''}}">
            <label for="git_repo" class="control-label">{{ 'Git Repository' }}</label>
            <input type="text" name="git_repo" id="git_repo" placeholder="Git Repository" value="{{ isset($project->git_repo) ? $project->git_repo : old('git_repo') }}" >
            {!! $errors->first('git_repo', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <label>Starts From </label>
        <div id="datepicker_starts_from" class="input-group date" data-date-format="mm-dd-yyyy">
            <input required type="text" name="starts_from" value="{{ isset($project->starts_from) ? \Carbon\Carbon::parse($project->starts_from)->format("m/d/Y") : old('starts_from')}}" readonly />
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
        </div>
        {!! $errors->first('starts_from', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-6">
        <label>Deadline </label>
        <div id="datepicker_deadline" class="input-group date" data-date-format="mm-dd-yyyy">
            <input required type="text" name="deadline" value="{{ isset($project->deadline) ? \Carbon\Carbon::parse($project->deadline)->format("m/d/Y") : old('deadline')}}" readonly />
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
        </div>
        {!! $errors->first('deadline', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('desc') ? 'has-error' : ''}}">
            <label for="desc" class="control-label">{{ 'Desc' }}</label>
            <textarea class="form-control" rows="5" name="desc" type="textarea" id="desc" >{{ isset($project->desc) ? $project->desc : ''}}</textarea>
            {!! $errors->first('desc', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('demo_web_link') ? 'has-error' : ''}}">
            <label for="demo_web_link" class="control-label">{{ 'Demo Web Link' }}</label>
            <input type="text" name="demo_web_link" id="demo_web_link" placeholder="Demo Web Link" value="{{ isset($project->demo_web_link) ? $project->demo_web_link : old('demo_web_link') }}" >
            {!! $errors->first('demo_web_link', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('trello_link') ? 'has-error' : ''}}">
            <label for="trello_link" class="control-label">{{ 'Trello Link' }}</label>
            <input type="text" name="trello_link" id="trello_link" placeholder="Trello Link" value="{{ isset($project->trello_link) ? $project->trello_link : old('trello_link') }}" >
            {!! $errors->first('trello_link', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('gd_link') ? 'has-error' : ''}}">
            <label for="gd_link" class="control-label">{{ 'Google Drive Link' }}</label>
            <input type="text" name="gd_link" id="gd_link" placeholder="Google Drive Link" value="{{ isset($project->gd_link) ? $project->gd_link : old('gd_link') }}" >
            {!! $errors->first('gd_link', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('live_project_link') ? 'has-error' : ''}}">
            <label for="live_project_link" class="control-label">{{ 'Live Project Link' }}</label>
            <input type="text" name="live_project_link" id="live_project_link" placeholder="Live Project Link" value="{{ isset($project->live_project_link) ? $project->live_project_link : old('live_project_link') }}" >
            {!! $errors->first('live_project_link', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-4">
        <label for="feedback_from_client">Feedback From Client</label>
        <select id="feedback_from_client" name="feedback_from_client">
            <option value="0.0" @if($project->feedback_from_client == 0.00) {{ 'selected' }} @endif>0.0</option>
            <option value="0.5" @if($project->feedback_from_client == 0.50) {{ 'selected' }} @endif>0.5</option>
            <option value="1.0" @if($project->feedback_from_client == 1.00) {{ 'selected' }} @endif>1.0</option>
            <option value="1.5" @if($project->feedback_from_client == 1.50) {{ 'selected' }} @endif>1.5</option>
            <option value="2.0" @if($project->feedback_from_client == 2.00) {{ 'selected' }} @endif>2.0</option>
            <option value="2.5" @if($project->feedback_from_client == 2.50) {{ 'selected' }} @endif>2.5</option>
            <option value="3.0" @if($project->feedback_from_client == 3.00) {{ 'selected' }} @endif>3.0</option>
            <option value="3.5" @if($project->feedback_from_client == 3.50) {{ 'selected' }} @endif>3.5</option>
            <option value="4.0" @if($project->feedback_from_client == 4.00) {{ 'selected' }} @endif>4.0</option>
            <option value="4.5" @if($project->feedback_from_client == 4.50) {{ 'selected' }} @endif>4.5</option>
            <option value="5.0" @if($project->feedback_from_client == 5.00) {{ 'selected' }} @endif>5.0</option>
        </select>
        {!! $errors->first('feedback_from_client', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-4">
        <label for="feedback_to_client">Feedback To Client</label>
        <select id="feedback_to_client" name="feedback_to_client">
            <option value="0.0" @if($project->feedback_to_client == 0.00) {{ 'selected' }} @endif>0.0</option>
            <option value="0.5" @if($project->feedback_to_client == 0.50) {{ 'selected' }} @endif>0.5</option>
            <option value="1.0" @if($project->feedback_to_client == 1.00) {{ 'selected' }} @endif>1.0</option>
            <option value="1.5" @if($project->feedback_to_client == 1.50) {{ 'selected' }} @endif>1.5</option>
            <option value="2.0" @if($project->feedback_to_client == 2.00) {{ 'selected' }} @endif>2.0</option>
            <option value="2.5" @if($project->feedback_to_client == 2.50) {{ 'selected' }} @endif>2.5</option>
            <option value="3.0" @if($project->feedback_to_client == 3.00) {{ 'selected' }} @endif>3.0</option>
            <option value="3.5" @if($project->feedback_to_client == 3.50) {{ 'selected' }} @endif>3.5</option>
            <option value="4.0" @if($project->feedback_to_client == 4.00) {{ 'selected' }} @endif>4.0</option>
            <option value="4.5" @if($project->feedback_to_client == 4.50) {{ 'selected' }} @endif>4.5</option>
            <option value="5.0" @if($project->feedback_to_client == 5.00) {{ 'selected' }} @endif>5.0</option>
        </select>
        {!! $errors->first('feedback_to_client', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<button type="submit" class="customButton">{{ $formMode === 'edit' ? 'Update' : 'Create' }}</button>


