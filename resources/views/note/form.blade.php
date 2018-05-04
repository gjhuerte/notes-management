<input type="hidden" name="_token" value="{{ csrf_token() }}" />
<div class="form-group">
	<label>Title</label>
    <input type="text" value="{{ isset($note->title) ? $note->title : old('title') }}" id="title" class="form-control"  placeholder="Title" name="title" />
</div>

<div class="form-group">
	<label>Details</label>
	<textarea id="details" class="form-control" name="details">{{ isset($note->details) ? $note->details : old('details') }}</textarea>
</div>

<div class="form-group">
	<button type="submit" id="submit" class="btn btn-primary" name="submit" value="">Submit</button>
</div>