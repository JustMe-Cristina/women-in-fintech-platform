@extends('layouts.master')

@section('title', 'Members')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Members</h1>

        <div class="d-flex gap-2">
            <a class="btn btn-success" href="{{ route('members.export') }}">
                Export CSV
            </a>

            <a class="btn btn-primary" href="{{ route('members.create') }}">
                Add Member
            </a>
        </div>
    </div>

    {{-- Search + Filters (GET) --}}
    <form method="GET" action="{{ route('members.index') }}" class="card shadow-sm mb-3">
        <div class="card-body">
            <div class="row g-2">
                {{-- Search by name/email --}}
                <div class="col-md-4">
                    <label class="form-label">Search (name/email)</label>
                    <input type="text" name="search" class="form-control"
                           value="{{ request('search') }}"
                           placeholder="e.g. Ana or ana@email.com">
                </div>

                {{-- Filter profession --}}
                <div class="col-md-3">
                    <label class="form-label">Profession</label>
                    <input type="text" name="profession" class="form-control"
                           value="{{ request('profession') }}"
                           placeholder="e.g. Software Developer">
                </div>

                {{-- Filter company --}}
                <div class="col-md-3">
                    <label class="form-label">Company</label>
                    <input type="text" name="company" class="form-control"
                           value="{{ request('company') }}"
                           placeholder="e.g. Google">
                </div>

                {{-- Filter status --}}
                <div class="col-md-2">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">-- any --</option>
                        <option value="active" @selected(request('status')==='active')>active</option>
                        <option value="inactive" @selected(request('status')==='inactive')>inactive</option>
                    </select>
                </div>

                <div class="col-12 d-flex gap-2 mt-2">
                    <button class="btn btn-primary" type="submit">Apply</button>
                    <a class="btn btn-outline-secondary" href="{{ route('members.index') }}">Reset</a>
                </div>
            </div>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Profession</th>
                        <th>Company</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($members as $member)
                        <tr>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->email }}</td>
                            <td>{{ $member->profession }}</td>
                            <td>{{ $member->company }}</td>
                            <td>
                            <span class="badge {{ $member->status === 'active' ? 'text-bg-success' : 'text-bg-secondary' }}">
                                {{ $member->status }}
                            </span>
                            </td>
                            <td class="text-end">

                                <a class="btn btn-sm btn-outline-secondary"
                                   href="{{ route('stories.index', $member->id) }}">
                                    Stories
                                </a>

                                <a class="btn btn-sm btn-outline-primary" href="{{ route('members.edit', $member->id) }}">
                                    Edit
                                </a>

                                <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Sigur vrei să ștergi acest membru?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No members found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white">
            {{-- păstrează query string la paginare --}}
            {{ $members->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
