<div class="row">
    <div class="col-md-4">
        <label for="project_id">Project</label>
        <select required id="project_id" name="project_id">
            <option value="" disabled selected>Select Project</option>
            @foreach($projects as $project)
                <option value="{{ $project->id }}" @if($credit->project_id == $project->id) {{ 'selected' }} @endif>{{ Str::limit($project->title, 50) }}</option>
            @endforeach
        </select>
        {!! $errors->first('project_id', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
            <label for="amount" class="control-label">{{ 'Amount ($)' }}</label>
            <input type="number" name="amount" id="amount" placeholder="amount *" value="{{ isset($credit->amount) ? $credit->amount : ''}}" >
            {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-4">
        <label>Date </label>
        <div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
            <input required type="text" name="date" value="{{ isset($credit->date) ? \Carbon\Carbon::parse($credit->date)->format("m/d/Y") : old('date')}}" readonly />
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
        </div>
        {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<button type="submit" class="customButton">{{ $formMode === 'edit' ? 'Update' : 'Create' }}</button>
