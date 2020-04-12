<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="control-label">{{ 'Name' }}</label>
            <input type="text" name="name" id="name" placeholder="Name *" value="{{ isset($client->name) ? $client->name : ''}}" >
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
            <label for="email" class="control-label">{{ 'Email' }}</label>
            <input type="text" name="email" id="email" placeholder="Email *" value="{{ isset($client->email) ? $client->email : ''}}" >
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('platform_id') ? 'has-error' : ''}}">
            <label>Plarform</label>
            <select id="platform_id" name="platform_id" required>
                <option disabled selected>Select Platform</option>
                @foreach($platforms as $platform)
                    <option value="{{ $platform->id }}" @if($client->platform_id == $platform->id) {{ 'selected' }} @endif>{{ ucfirst($platform->name) }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('skype') ? 'has-error' : ''}}">
            <label for="skype" class="control-label">{{ 'Skype' }}</label>
            <input type="text" name="skype" id="skype" placeholder="Skype *" value="{{ isset($client->name) ? $client->name : ''}}" >
            {!! $errors->first('skype', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('desc') ? 'has-error' : ''}}">
            <label for="desc" class="control-label">{{ 'Desc' }}</label>
            <textarea class="form-control" rows="5" name="desc" type="textarea" id="desc" placeholder="Description *" >{{ isset($client->desc) ? $client->desc : ''}}</textarea>
            {!! $errors->first('desc', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <label for="desc" class="control-label">{{ 'Image' }}</label>
        <div class='file-input'>
            <input required type='file' name="image" onchange="readURL(this);">
            <span class='button'>Choose</span>
            <span class='label' data-js-label>No file selected</label>
        </div>
    </div>
    <div class="col-md-6 mg-t-30">
        @if($client->image)
        <img id="blah" class="uploaded-img-preview" src="{{ asset('storage/clients/'.$client->image) }}"
            alt="{{ $client->name }}" />
        @else
        <img id="blah" class="uploaded-img-preview" src="{{ asset('assets/img/user.jpg') }}" alt="{{ $client->name }}" />
        @endif
    </div>
</div>

<button type="submit" class="customButton">{{ $formMode === 'edit' ? 'Update' : 'Create' }}</button>
