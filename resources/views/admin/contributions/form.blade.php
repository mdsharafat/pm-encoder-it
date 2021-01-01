<div class="row">
    <div class="col-md-4">
        <label for="project_id">Project</label>
        <select id="project_id" name="project_id" class="project_id">
            <option value="" disabled selected>Select Project</option>
            @foreach($projects as $project)
                <option value="{{ $project->id }}" @if($contribution->project_id == $project->id) {{ 'selected' }} @endif>{{ Str::limit($project->title, 50) }}</option>
            @endforeach
        </select>
        {!! $errors->first('project_id', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="col-md-4">
        <label for="project_id">Employee</label>
        <select required id="emp_id" name="emp_id" class="emp_id">
            <option value="" disabled selected>Select Employee</option>
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}" @if($contribution->emp_id == $employee->id) {{ 'selected' }} @endif>{{ Str::limit($employee->full_name, 50) }}</option>
            @endforeach
        </select>
        {!! $errors->first('emp_id', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('contribution') ? 'has-error' : ''}}">
            <label for="contribution" class="control-label"><span class="remaing_contribution">Contribution (%)</span></label>
            <input required type="number" class="contribution" name="contribution" id="contribution" placeholder="Contribution *" value="{{ isset($contribution->contribution) ? $contribution->contribution : ''}}" >
            {!! $errors->first('contribution', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('comment') ? 'has-error' : ''}}">
            <label for="comment" class="control-label">{{ 'Comment' }}</label>
            <textarea class="form-control" rows="5" name="comment" type="textarea" id="comment" >{{ isset($contribution->comment) ? $contribution->comment : ''}}</textarea>
            {!! $errors->first('comment', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>


<button type="submit" class="customButton add_contribution">{{ $formMode === 'edit' ? 'Update' : 'Create' }}</button>
