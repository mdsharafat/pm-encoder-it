<div class="row">
    <div class="col-md-6">
        <label for="assigned_to" class="control-label">{{ 'Assign To' }}</label>
        <select required id="assigned_to" name="assigned_to" >
            <option value="" default selected>{{ 'Select Employee' }}</option>
            @foreach ($employees as $employee)
                <option value="{{ $employee->id }}" @if($task->assigned_to == $employee->id) {{ 'selected' }} @endif>{{ $employee->full_name }}</option>
            @endforeach
        </select>
        {!! $errors->first('assigned_to', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-6">
        <label for="project_id" class="control-label">{{ 'Project' }}</label>
        <select required id="project_id" name="project_id" >
            <option value="" default selected>Select Project</option>
            @foreach ($projects as $project)
                <option value="{{ $project->id }}" @if($task->project_id == $project->id) {{ 'selected' }} @endif>{{ $project->title }}</option>
            @endforeach
        </select>
        {!! $errors->first('project_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('deadline') ? 'has-error' : ''}}">
            <label for="deadline" class="control-label">{{ 'Deadline' }}</label>
            <input type="text" name="deadline" class="datetimepicker" placeholder="{{ isset($task->deadline) ? $task->deadline : 'Deadline *'}}"/>
            {!! $errors->first('deadline', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <label for="total_point">Total Points</label>
        <select id="total_point" name="total_point" required >
            <option value="01.00" @if($task->total_point == 01.00) {{ 'selected' }} @endif>01.00</option>
            <option value="02.00" @if($task->total_point == 02.00) {{ 'selected' }} @endif>02.00</option>
            <option value="03.00" @if($task->total_point == 03.00) {{ 'selected' }} @endif>03.00</option>
            <option value="04.00" @if($task->total_point == 04.00) {{ 'selected' }} @endif>04.00</option>
            <option value="05.00" @if($task->total_point == 05.00) {{ 'selected' }} @endif>05.00</option>
            <option value="06.00" @if($task->total_point == 06.00) {{ 'selected' }} @endif>06.00</option>
            <option value="07.00" @if($task->total_point == 07.00) {{ 'selected' }} @endif>07.00</option>
            <option value="08.00" @if($task->total_point == 08.00) {{ 'selected' }} @endif>08.00</option>
            <option value="09.00" @if($task->total_point == 09.00) {{ 'selected' }} @endif>09.00</option>
            <option value="10.00" @if($task->total_point == 10.00) {{ 'selected' }} @endif>10.00</option>
            <option value="11.00" @if($task->total_point == 11.00) {{ 'selected' }} @endif>11.00</option>
            <option value="12.00" @if($task->total_point == 12.00) {{ 'selected' }} @endif>12.00</option>
            <option value="13.00" @if($task->total_point == 13.00) {{ 'selected' }} @endif>13.00</option>
            <option value="14.00" @if($task->total_point == 14.00) {{ 'selected' }} @endif>14.00</option>
            <option value="15.00" @if($task->total_point == 15.00) {{ 'selected' }} @endif>15.00</option>
            <option value="16.00" @if($task->total_point == 16.00) {{ 'selected' }} @endif>16.00</option>
            <option value="17.00" @if($task->total_point == 17.00) {{ 'selected' }} @endif>17.00</option>
            <option value="18.00" @if($task->total_point == 18.00) {{ 'selected' }} @endif>18.00</option>
            <option value="19.00" @if($task->total_point == 19.00) {{ 'selected' }} @endif>19.00</option>
            <option value="20.00" @if($task->total_point == 20.00) {{ 'selected' }} @endif>20.00</option>
        </select>
        {!! $errors->first('total_point', '<p class="help-block">:message</p>') !!}
    </div>
    {{-- <div class="col-md-4">
        <label for="received_point">Received Points</label>
        <select id="received_point" name="received_point" required >
            <option value="0.50" @if($task->received_point == 00.00) {{ 'selected' }} @endif>00.00</option>
            <option value="0.50" @if($task->received_point == 01.00) {{ 'selected' }} @endif>01.00</option>
            <option value="1.00" @if($task->received_point == 02.00) {{ 'selected' }} @endif>02.00</option>
            <option value="1.50" @if($task->received_point == 03.00) {{ 'selected' }} @endif>03.00</option>
            <option value="2.00" @if($task->received_point == 04.00) {{ 'selected' }} @endif>04.00</option>
            <option value="2.50" @if($task->received_point == 05.00) {{ 'selected' }} @endif>05.00</option>
            <option value="3.00" @if($task->received_point == 06.00) {{ 'selected' }} @endif>06.00</option>
            <option value="3.50" @if($task->received_point == 07.00) {{ 'selected' }} @endif>07.00</option>
            <option value="4.00" @if($task->received_point == 08.00) {{ 'selected' }} @endif>08.00</option>
            <option value="4.50" @if($task->received_point == 09.00) {{ 'selected' }} @endif>09.00</option>
            <option value="5.00" @if($task->received_point == 10.00) {{ 'selected' }} @endif>10.00</option>
            <option value="0.00" @if($task->received_point == 11.00) {{ 'selected' }} @endif>11.00</option>
            <option value="0.00" @if($task->received_point == 12.00) {{ 'selected' }} @endif>12.00</option>
            <option value="0.00" @if($task->received_point == 13.00) {{ 'selected' }} @endif>13.00</option>
            <option value="0.00" @if($task->received_point == 14.00) {{ 'selected' }} @endif>14.00</option>
            <option value="0.00" @if($task->received_point == 15.00) {{ 'selected' }} @endif>15.00</option>
            <option value="0.00" @if($task->received_point == 16.00) {{ 'selected' }} @endif>16.00</option>
            <option value="0.00" @if($task->received_point == 17.00) {{ 'selected' }} @endif>17.00</option>
            <option value="0.00" @if($task->received_point == 18.00) {{ 'selected' }} @endif>18.00</option>
            <option value="0.00" @if($task->received_point == 19.00) {{ 'selected' }} @endif>19.00</option>
            <option value="0.00" @if($task->received_point == 20.00) {{ 'selected' }} @endif>20.00</option>
        </select>
        {!! $errors->first('received_point', '<p class="help-block">:message</p>') !!}


    </div> --}}
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('task') ? 'has-error' : ''}}">
            <label for="task" class="control-label">{{ 'Task' }}</label>
            <textarea class="form-control" rows="5" name="task" type="textarea" id="task" >{{ isset($task->task) ? $task->task : ''}}</textarea>
            {!! $errors->first('task', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<button type="submit" class="customButton">{{ $formMode === 'edit' ? 'Update' : 'Create' }}</button>
