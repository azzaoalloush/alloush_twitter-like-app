@extends('layout.layout')

@section('content')
<div class="row">
    <div class="col-3">
    </div>

    <div class="col-6">
        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">← Back</a>

        <h2>Edit Idea</h2>
        <form action="{{ route('ideas.update', $idea->id) }}" method="post">
            @csrf
            @method('put')
            <div class="mb-3">
                <textarea name="content" class="form-control" rows="3">{{ $idea->content }}</textarea>
                @error('content')
                    <span class="d-block fs-6 text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-dark">Update</button>
        </form>
    </div>

    <div class="col-3">
        @include('shared.search-bar')
    </div>
</div>
@endsection
