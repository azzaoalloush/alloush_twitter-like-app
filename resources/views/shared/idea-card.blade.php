<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                    src="https://api.dicebear.com/6.x/fun-emoji/svg?seed={{ $idea->user->name }}" alt="{{ $idea->user->name }}">
                <div>
                    <h5 class="card-title mb-0">
                        <a href="{{ route('profile.show', $idea->user) }}">
                            {{ $idea->user->name }}
                        </a>
                    </h5>
                </div>
            </div>
            <div>
                @can('update', $idea)
                    <a class="mx-2" href="{{ route('ideas.edit', $idea->id) }}">Edit</a>
                @endcan

                <a href="{{ route('ideas.show', $idea->id) }}">View</a>

                @can('delete', $idea)
                    <form method="POST" action="{{ route('ideas.destroy', $idea->id) }}" style="display:inline;"
                          onsubmit="return confirm('Are you sure you want to delete this idea?');">
                        @csrf
                        @method('delete')
                        <button class="ms-1 btn btn-danger btn-sm">X</button>
                    </form>
                @endcan
            </div>
        </div>
    </div>

    <div class="card-body">
        @if ($editing ?? false)
            <form action="{{ route('ideas.update', $idea->id) }}" method="post">
                @csrf
                @method('put')
                <div class="mb-3">
                    <textarea name="content" class="form-control" id="content" rows="3">{{ $idea->content }}</textarea>
                    @error('content')
                        <span class="d-block fs-6 text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="btn btn-dark mb-2 btn-sm">Update</button>
                </div>
            </form>
        @else
            <p class="fs-6 fw-light text-muted">
                {{ $idea->content }}
                @if ($idea->updated_at->gt($idea->created_at))
                    <span class="text-muted fst-italic">(edited)</span>
                @endif
            </p>
        @endif

        <div class="d-flex justify-content-between align-items-center mt-2">
            <div>
                <span class="fw-light fs-6">
                    <span class="fas fa-heart me-1"></span>
                    {{ $idea->likes->count() }}
                </span>

                @auth
                    @if($idea->likedBy(auth()->user()))
                        <form action="{{ route('ideas.unlike', $idea) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link p-0 text-danger">Unlike</button>
                        </form>
                    @else
                        <form action="{{ route('ideas.like', $idea) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 text-primary">Like</button>
                        </form>
                    @endif
                @endauth
            </div>

            <div>
                <span class="fs-6 fw-light text-muted">
                    <span class="fas fa-clock"></span>
                    {{ $idea->created_at->diffForHumans() }}
                </span>
            </div>
        </div>

        @include('shared.comments-box')
    </div>
</div>
