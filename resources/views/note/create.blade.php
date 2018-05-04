@extends('layouts.app')

@section('styles')

@endsection

@section('content')
<div class="container">

	<div class="card">
		<div class="card-body">
    		@include('alert.default')
			<div class="card-title">Create a Note:</div>
		    <form method="post" action="{{ url('note') }}">
				@include('note.form')
		    </form>
		</div>
	</div>
</div>
@endsection

@section('scripts')

@endsection
