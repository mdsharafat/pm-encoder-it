<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="control-label">{{ 'Name' }}</label>
            <textarea class="form-control" rows="5" name="name" type="textarea" id="name" >{{ isset($miscellaneousExpenses->name) ? $miscellaneousExpenses->name : ''}}</textarea>
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
            <label for="amount" class="control-label">{{ 'Amount ($)' }}</label>
            <input type="number" name="amount" id="amount" placeholder="amount *" value="{{ isset($miscellaneousExpenses->amount) ? $miscellaneousExpenses->amount : ''}}" >
            {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <label>Date </label>
        <div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
            <input required type="text" name="date" value="{{ isset($miscellaneousExpenses->date) ? \Carbon\Carbon::parse($miscellaneousExpenses->date)->format("m/d/Y") : old('date')}}" readonly />
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
        </div>
        {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
    </div>
</div>





<button type="submit" class="customButton">{{ $formMode === 'edit' ? 'Update' : 'Create' }}</button>
