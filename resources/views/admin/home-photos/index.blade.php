@extends('adminlte::page')

@section('title', 'Homepage Photos')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0"><i class="fas fa-images mr-2 text-success"></i>Homepage Photos</h1>
        <a href="{{ route('home-photos.create') }}" class="btn btn-success"><i class="fas fa-plus mr-1"></i> Add Photo</a>
    </div>
@stop

@section('content')
    @include('layouts.partials._notification')
    <div class="alert alert-info">
        <strong>How it works:</strong> the "ছবি" slider on the home page shows the photos listed here that are <b>Active</b> and inside their
        <b>Show from / Show until</b> dates (leave the dates empty to show always). Photos appear in <b>Order</b> (lowest first).
        Use the eye button to switch a photo on or off for today. If no photo is visible, the slider falls back to the latest news.
    </div>
    <div class="card card-outline card-success">
        <div class="card-header"><h3 class="card-title">Photos for the home page slider</h3><div class="card-tools"><span class="badge badge-light">{{ $photos->total() }} total</span></div></div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead><tr><th>Photo</th><th>Title</th><th>Schedule</th><th>Order</th><th>Today</th><th class="text-right">Actions</th></tr></thead>
                    <tbody>
                    @forelse($photos as $photo)
                        @php
                            $live = $photo->is_active
                                && (!$photo->show_from || $photo->show_from->lte(today()))
                                && (!$photo->show_until || $photo->show_until->gte(today()));
                        @endphp
                        <tr>
                            <td style="width:120px"><img src="{{ $photo->image_url }}" alt="{{ $photo->title }}" class="img-thumbnail" style="width:100px;height:64px;object-fit:cover"></td>
                            <td><strong>{{ $photo->title }}</strong>@if($photo->url)<small class="d-block text-muted">{{ \Illuminate\Support\Str::limit($photo->url, 40) }}</small>@endif</td>
                            <td class="text-nowrap">
                                @if($photo->show_from || $photo->show_until)
                                    {{ $photo->show_from?->format('d M Y') ?? '…' }} → {{ $photo->show_until?->format('d M Y') ?? '…' }}
                                @else <span class="text-muted">Always</span> @endif
                            </td>
                            <td>{{ $photo->sort_order }}</td>
                            <td><span class="badge badge-{{ $live ? 'success' : 'secondary' }}">{{ $live ? 'Showing' : 'Not showing' }}</span></td>
                            <td class="text-right text-nowrap">
                                <form action="{{ route('home-photos.toggle', $photo) }}" method="POST" class="d-inline">@csrf @method('PATCH')
                                    <button class="btn btn-sm btn-outline-{{ $photo->is_active ? 'secondary' : 'success' }}" title="{{ $photo->is_active ? 'Hide' : 'Show' }}"><i class="fas fa-{{ $photo->is_active ? 'eye-slash' : 'eye' }}"></i></button>
                                </form>
                                <a href="{{ route('home-photos.edit', $photo) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('home-photos.destroy', $photo) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this photo?')">@csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-5 text-muted">No photos yet. Click "Add Photo" to upload one.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($photos->hasPages())<div class="card-footer">{{ $photos->links() }}</div>@endif
    </div>
@stop

@section('footer') @include('layouts.partials._footer') @stop
