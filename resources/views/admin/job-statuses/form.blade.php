<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="control-label">{{ 'Name' }}</label>
            <input type="text" name="name" id="name" placeholder="name *" value="{{ isset($jobstatus->name) ? $jobstatus->name : ''}}" >
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6 mg-t-30">
        <button type="submit" class="customButton">{{ $formMode === 'edit' ? 'Update' : 'Create' }}</button>
    </div>
</div>



