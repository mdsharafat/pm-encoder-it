<div class="row">
    <div class="col-md-6">
        <label for="emp_id">Employee</label>
        <select id="emp_id" name="emp_id" required @if($formMode === 'edit') {{ 'disabled' }} @endif>
            <option value="" disabled selected>Select Employee</option>
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}" @if($employee->id == $review->emp_id) {{ 'selected' }} @endif>{{ $employee->full_name }}</option>
            @endforeach
        </select>
        {!! $errors->first('emp_id', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-6">
        <label for="point">Points</label>
        <select id="point" name="point" required >
            <option value="0.00" @if($review->point == 0.00) {{ 'selected' }} @endif>0.00</option>
            <option value="0.50" @if($review->point == 0.50) {{ 'selected' }} @endif>0.50</option>
            <option value="1.00" @if($review->point == 1.00) {{ 'selected' }} @endif>1.00</option>
            <option value="1.50" @if($review->point == 1.50) {{ 'selected' }} @endif>1.50</option>
            <option value="2.00" @if($review->point == 2.00) {{ 'selected' }} @endif>2.00</option>
            <option value="2.50" @if($review->point == 2.50) {{ 'selected' }} @endif>2.50</option>
            <option value="3.00" @if($review->point == 3.00) {{ 'selected' }} @endif>3.00</option>
            <option value="3.50" @if($review->point == 3.50) {{ 'selected' }} @endif>3.50</option>
            <option value="4.00" @if($review->point == 4.00) {{ 'selected' }} @endif>4.00</option>
            <option value="4.50" @if($review->point == 4.50) {{ 'selected' }} @endif>4.50</option>
            <option value="5.00" @if($review->point == 5.00) {{ 'selected' }} @endif>5.00</option>
        </select>
        {!! $errors->first('point', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('note') ? 'has-error' : ''}}">
            <label for="note" class="control-label">{{ 'Note' }}</label>
            <textarea class="form-control" rows="5" name="note" type="textarea" id="note" >{{ isset($review->note) ? $review->note : ''}}</textarea>
            {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<button type="submit" class="customButton">{{ $formMode === 'edit' ? 'Update' : 'Create' }}</button>
