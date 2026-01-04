@extends('layouts.master')

@section('title', 'Events')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Upcoming Events</h1>
        <a class="btn btn-primary" href="{{ route('events.create') }}">Add Event</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @forelse($events as $e)
                <div class="border rounded p-3 mb-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h2 class="h6 mb-1">{{ $e->name }}</h2>
                            <div class="text-muted small">
                                Date: {{ \Carbon\Carbon::parse($e->event_date)->format('d.m.Y H:i') }}
                            </div>
                        </div>

                        <form method="POST"
                              action="{{ route('events.destroy', $e->id) }}"
                              onsubmit="return confirm('Are you sure you want to delete this event?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </div>

                    @if($e->description)
                        <p class="mb-0 mt-2">{{ $e->description }}</p>
                    @endif
                </div>
            @empty
                <div class="text-muted text-center py-4">
                    No upcoming events.
                </div>
            @endforelse
        </div>

        @if($events->hasPages())
            <div class="card-footer bg-white">
                {{ $events->links() }}
            </div>
        @endif
    </div>
@endsection
