@extends('layouts.master')

@section('title', 'Edit Member')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Edit Member</h1>
        <a href="{{ route('members.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('members.update', $member->id) }}" class="row g-3">
                @csrf
                @method('PUT')

                <div class="col-md-6">
                    <label class="form-label">Name *</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name', $member->name) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email', $member->email) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Profession *</label>
                    <input type="text" name="profession" class="form-control"
                           value="{{ old('profession', $member->profession) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Company (optional)</label>
                    <input type="text" name="company" class="form-control"
                           value="{{ old('company', $member->company) }}">
                </div>

                <div class="col-md-8">
                    <label class="form-label">LinkedIn URL (optional)</label>
                    <input type="url" name="linkedin_url" class="form-control"
                           value="{{ old('linkedin_url', $member->linkedin_url) }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-select" required>
                        <option value="active" @selected(old('status', $member->status)==='active')>active</option>
                        <option value="inactive" @selected(old('status', $member->status)==='inactive')>inactive</option>
                    </select>
                </div>

                <div class="col-12 d-flex gap-2">
                    <button class="btn btn-primary" type="submit">Update</button>
                    <a class="btn btn-outline-secondary" href="{{ route('members.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
