@extends('layout.layout')

@section('content')
<div class="row">
    <div class="col-3">
    </div>



    <div class="col-6">
        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">← Back</a>
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title">{{ $user->name }}</h2>
                <p class="mb-1">Joined: {{ $stats['joined']->toFormattedDateString() }}</p>
                <p class="mb-1">Ideas: {{ $stats['idea_count'] }}</p>
                <p class="mb-1">Likes Received: {{ $stats['total_likes_received'] }}</p>
            </div>
        </div>

        <hr>

        @foreach($ideas as $idea)
            <div class="mt-3">
                <div class="card">
                    <div class="card-body">
                        <p class="fs-6 fw-light text-muted">
                            {{ $idea->content }}
                            @if ($idea->updated_at->gt($idea->created_at))
                                <span class="text-muted fst-italic">(edited)</span>
                            @endif
                        </p>
                        @include('shared.idea-card', ['idea' => $idea])
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="col-3">
        @include('shared.search-bar')
    </div>
</div>
@endsection
