@extends('layouts.master')

@section('title', 'Add Event')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Add Event</h1>
        <a class="btn btn-outline-secondary" href="{{ route('events.index') }}">Back</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('events.store') }}" class="row g-3">
                @csrf

                <div class="col-12">
                    <label class="form-label">Name *</label>
                    <input class="form-control" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Event date *</label>
                    <input type="datetime-local" class="form-control" name="event_date" value="{{ old('event_date') }}" required>
                </div>

                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" rows="4" name="description">{{ old('description') }}</textarea>
                </div>

                <div class="col-12 d-flex gap-2">
                    <button class="btn btn-primary">Save</button>
                    <a class="btn btn-outline-secondary" href="{{ route('events.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
