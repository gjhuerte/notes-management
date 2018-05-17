@extends('layouts.app')

@section('styles')
<style type="text/css">

</style>
@endsection

@section('content')
<div class="container">

    @include('alert.default')
    <div class="row">

        <div class="col-md-12 mb-2">
            <a type="button" id="create" class="float-right btn btn-primary" href="{{ url('note/create') }}">Create</a>
        </div>

        <div class="clearfix"></div>

        @if(count($note) >)
        <div class="col-md-4 mt-2 d-flex align-items-stretch">
            <div class="card bg-light">

                <div class="card-header bg-primary text-white">
                    <span class="float-right badge badge-light">{{ Carbon\Carbon::parse($note->created_at)->diffForHumans() }}</span>
                    <div class="card-title">{{ $note->title }}</div>
                </div>

                <div class="card-body">
                    <blockquote class="lead">{{ $note->details }}</blockquote>
                </div>

                <div class="card-footer bg-light">
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
                   {{  App\Quote::randomize() }}
                </div>
            </div>
        </div>
        @end

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
