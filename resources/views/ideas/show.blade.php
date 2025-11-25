@extends('layout.layout')

@section('content')
<div class="row">
    <div class="col-3">
    </div>

    <div class="col-6">
        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">← Back</a>

        @include('shared.idea-card', ['idea' => $idea])
    </div>

    <div class="col-3">
        @include('shared.search-bar')
    </div>
</div>
@endsection
