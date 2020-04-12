<div class="row">
    <div class="col-md-4">
        <label>Name</label>
        <input type="text" name="name" id="name" placeholder="name *" value="{{ isset($platform->name) ? $platform->name : ''}}" >
    </div>
    <div class="col-md-4">
        <label>Ratings</label>
        <input type="number" step=0.01 name="ratings" id="ratings" placeholder="ratings *" value="{{ isset($platform->ratings) ? $platform->ratings : ''}}" >
    </div>
    <div class="col-md-4 mg-t-30">
        <button type="submit" class="customButton">{{ $formMode === 'edit' ? 'Update' : 'Create' }}</button>
    </div>
</div>
