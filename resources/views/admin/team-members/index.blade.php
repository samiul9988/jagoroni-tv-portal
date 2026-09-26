@extends('adminlte::page')

@section('title', 'Team Members')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0"><i class="fas fa-users mr-2 text-success"></i>Team Members</h1>
        <a href="{{ route('team-members.create') }}" class="btn btn-success"><i class="fas fa-plus mr-1"></i> Add Member</a>
    </div>
@stop

@section('content')
    @include('layouts.partials._notification')
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">Shown on the public <a href="{{ url('/team') }}" target="_blank">Our Team</a> page</h3>
            <div class="card-tools"><span class="badge badge-light">{{ $members->total() }} total</span></div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead><tr><th>Photo</th><th>Name</th><th>Designation</th><th>Role</th><th>Order</th><th>Status</th><th class="text-right">Actions</th></tr></thead>
                    <tbody>
                    @forelse($members as $member)
                        <tr>
                            <td style="width:80px">
                                @if($member->photo)
                                    <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="img-thumbnail" style="width:56px;height:56px;object-fit:cover">
                                @else
                                    <span class="d-inline-flex align-items-center justify-content-center bg-light border rounded" style="width:56px;height:56px"><i class="fas fa-user text-muted"></i></span>
                                @endif
                            </td>
                            <td><strong>{{ $member->name }}</strong></td>
                            <td>{{ $member->designation }}</td>
                            <td>@if($member->is_leader)<span class="badge badge-warning">Leader / Chairman</span>@else<span class="badge badge-light">Member</span>@endif</td>
                            <td>{{ $member->sort_order }}</td>
                            <td><span class="badge badge-{{ $member->is_active ? 'success' : 'secondary' }}">{{ $member->is_active ? 'Active' : 'Hidden' }}</span></td>
                            <td class="text-right text-nowrap">
                                <a href="{{ route('team-members.edit', $member) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('team-members.destroy', $member) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this team member?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-5 text-muted">No team members added yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($members->hasPages())<div class="card-footer">{{ $members->links() }}</div>@endif
    </div>
@stop

@section('footer') @include('layouts.partials._footer') @stop
