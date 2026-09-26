@extends('adminlte::page')

@section('title', 'Program Schedule')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0"><i class="fas fa-calendar-alt mr-2 text-success"></i>Live Program Schedule</h1>
        <div>
            <a href="{{ route('live-stream.edit') }}" class="btn btn-outline-danger"><i class="fas fa-broadcast-tower mr-1"></i> Stream settings</a>
            <a href="{{ route('live-programs.create') }}" class="btn btn-success"><i class="fas fa-plus mr-1"></i> Add Program</a>
        </div>
    </div>
@stop

@section('content')
    @include('layouts.partials._notification')
    <div class="alert alert-info">
        Programs repeat <b>every day</b> by time. The one whose time slot contains the current time is shown as <b>LIVE</b> on the live page.
        Tick <b>Featured</b> to also show a program (with its image) in the "সম্প্রচারিত অন্যান্য প্রোগ্রাম" slider.
    </div>
    <div class="card card-outline card-success">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead><tr><th>Time</th><th>Program</th><th>Featured</th><th>Order</th><th>Status</th><th class="text-right">Actions</th></tr></thead>
                    <tbody>
                    @forelse($programs as $program)
                        <tr>
                            <td class="text-nowrap"><b>{{ $program->start_label }}</b>@if($program->end_label) – {{ $program->end_label }}@endif
                                @if($program->is_active && $program->isOnAir($now))<span class="badge badge-danger ml-1">ON AIR</span>@endif</td>
                            <td><div class="d-flex align-items-center">@if($program->image)<img src="{{ $program->image_url }}" class="img-thumbnail mr-2" style="width:64px;height:40px;object-fit:cover">@endif<div><strong>{{ $program->title }}</strong>@if($program->subtitle)<small class="d-block text-muted">{{ $program->subtitle }}</small>@endif</div></div></td>
                            <td>@if($program->is_featured)<span class="badge badge-warning">Featured</span>@else<span class="text-muted">—</span>@endif</td>
                            <td>{{ $program->sort_order }}</td>
                            <td><span class="badge badge-{{ $program->is_active ? 'success' : 'secondary' }}">{{ $program->is_active ? 'Active' : 'Hidden' }}</span></td>
                            <td class="text-right text-nowrap">
                                <a href="{{ route('live-programs.edit', $program) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('live-programs.destroy', $program) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this program?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button></form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-5 text-muted">No programs yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($programs->hasPages())<div class="card-footer">{{ $programs->links() }}</div>@endif
    </div>
@stop

@section('footer') @include('layouts.partials._footer') @stop
