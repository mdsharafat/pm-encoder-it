<div class="row">
    <div class="col-md-6">
        <label>Date </label>
        <div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
            <input required type="text" name="date" value="{{ isset($leavemanagement->date) ? \Carbon\Carbon::parse($leavemanagement->date)->format("m/d/Y") : old('date')}}" readonly />
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
        </div>
        {!! $errors->first('deadline', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
            <label for="category" class="control-label">{{ 'Category' }}</label>
            <select required id="category" name="category" >
                <option disabled selected>Select category</option>
                @foreach (json_decode('{"1": "Casual Leave", "2": "Medical Leave", "3": "Paternity Leave", "4": "Maternity Leave"}', true) as $optionKey => $optionValue)
                    <option value="{{ $optionKey }}" {{ (isset($leavemanagement->category) && $leavemanagement->category == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                @endforeach
            </select>
            {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('reason') ? 'has-error' : ''}}">
            <label for="reason" class="control-label">{{ 'Reason' }}</label>
            <textarea required class="form-control" rows="5" name="reason" type="textarea" id="reason" >{{ isset($leavemanagement->reason) ? $leavemanagement->reason : ''}}</textarea>
            {!! $errors->first('reason', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<button type="submit" class="customButton">{{ $formMode === 'edit' ? 'Update' : 'Submit' }}</button>
