<div class="row">
    <div class="col-md-4">
        <label for="emp_id">Employee</label>
        <select required id="emp_id" name="emp_id">
            <option value="" disabled selected>Select Employee</option>
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}" @if($salaryExpense->emp_id == $employee->id) {{ 'selected' }} @endif>{{ $employee->full_name }}</option>
            @endforeach
        </select>
        {!! $errors->first('emp_id', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
            <label for="amount" class="control-label">{{ 'Amount ($)' }}</label>
            <input type="number" name="amount" id="amount" placeholder="amount *" value="{{ isset($salaryExpense->amount) ? $salaryExpense->amount : ''}}" >
            {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-4">
        <label>Salary Date </label>
        <div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
            <input required type="text" name="date" value="{{ isset($salaryExpense->date) ? \Carbon\Carbon::parse($salaryExpense->date)->format("m/d/Y") : old('date')}}" readonly />
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
        </div>
        {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<button type="submit" class="customButton">{{ $formMode === 'edit' ? 'Update' : 'Create' }}</button>
