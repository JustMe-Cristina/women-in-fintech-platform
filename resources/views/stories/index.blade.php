@extends('layouts.master')

@section('title', 'Success Stories')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h3 mb-0">Success Stories</h1>
            <div class="text-muted">Member: <strong>{{ $member->name }}</strong> ({{ $member->email }})</div>
        </div>

        <a class="btn btn-outline-secondary" href="{{ route('members.index') }}">Back to Members</a>
    </div>

    <div class="row g-3">
        {{-- FORM ADD STORY --}}
        <div class="col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="h5">Add a story</h2>

                    <form method="POST" action="{{ route('stories.store', $member->id) }}" class="mt-3">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Title *</label>
                            <input name="title" class="form-control" value="{{ old('title') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Story *</label>
                            <textarea name="story" rows="5" class="form-control" required>{{ old('story') }}</textarea>
                        </div>

                        <button class="btn btn-primary">Add Story</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- LIST STORIES --}}
        <div class="col-lg-7">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="h5 mb-3">Stories</h2>

                    @forelse($stories as $s)
                        <div class="border rounded p-3 mb-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="h6 mb-1">{{ $s->title }}</h3>
                                    <div class="text-muted small">{{ $s->created_at }}</div>
                                </div>

                                <form method="POST"
                                      action="{{ route('stories.destroy', [$member->id, $s->id]) }}"
                                      onsubmit="return confirm('Delete this story?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>

                            <p class="mb-0 mt-2">{{ $s->story }}</p>
                        </div>
                    @empty
                        <div class="text-muted">No stories yet.</div>
                    @endforelse

                    {{ $stories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
