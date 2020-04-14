<label for="project_id">Projects</label>
<select id="project_id" name="project_id" required >
    <option value="" disabled selected>Select Project</option>
    @foreach($projects as $project)
        <option value="{{ $project->id }}" @if($project->id == $projectnote->project_id) {{ 'selected' }} @endif>{{ $project->title }}</option>
    @endforeach
</select>
<div class="form-group {{ $errors->has('note') ? 'has-error' : ''}}">
    <label for="note" class="control-label">{{ 'Note' }}</label>
    <textarea class="form-control" rows="5" name="note" type="textarea" id="note" >{{ isset($projectnote->note) ? $projectnote->note : ''}}</textarea>
    {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
</div>


<button type="submit" class="customButton">{{ $formMode === 'edit' ? 'Update' : 'Create' }}</button>
