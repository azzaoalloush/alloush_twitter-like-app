@extends('layout.layout')

@section('content')
<div class="row">
    <div class="col-3">

    </div>

    <div class="col-6">
        <h2 class="mb-4">Latest Ideas</h2>

        @foreach($ideas as $idea)
            <div class="mt-3">
                @include('shared.idea-card', ['idea' => $idea])
            </div>
        @endforeach
    </div>

    <div class="col-3">
        @include('shared.search-bar')
    </div>
</div>
@endsection
