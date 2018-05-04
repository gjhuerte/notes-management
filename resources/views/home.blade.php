@extends('layouts.app')

@section('content')
<div class="container">

    @include('alert.default')
    <div class="row">

        <div class="col-md-12 mb-2">
            <a type="button" id="create" class="float-right btn btn-primary" href="{{ url('note/create') }}">Create</a>
        </div>

        <div class="clearfix"></div>

        @forelse($notes as $note)
        <div class="col-md-4 mt-2">
            <div class="card border-0">

                <div class="card-body">
                    <span class="float-right badge badge-info">{{ Carbon\Carbon::parse($note->created_at)->diffForHumans() }}</span>
                    <div class="clearfix card-title h6">{{ $note->title }}</div>
                    <blockquote class="lead">{{ $note->details }}</blockquote>
                </div>

                <div class="card-footer">
                    <div class="float-right">
                        <form method="post" action="{{ url("note/$note->id") }}">
                            <a href="{{ url("note/$note->id/edit") }}" class="btn btn-outline-info btn-sm">Edit</a>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="_method" value="delete" />
                            <button class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12">
            <div class="card bg-light">
                <div class="card-body">
                    <div class="card-title">Note:</div>
                    Empty Notes! Create One to Start Enjoying
                </div>
            </div>
        </div>
        @endforelse

        <div class="clearfix"></div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    let createButton = document.getElementById('create');

    createButton.addEventListener('click', function(event){
        alert('somethign')
        window.location.href = "{{ url('note/create') }}";
    })
</script>
@endsection
