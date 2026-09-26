@extends('adminlte::page')

@section('title', $photo->exists ? 'Edit Photo' : 'Add Photo')

@section('content_header')
    <h1><i class="fas fa-images mr-2 text-success"></i>{{ $photo->exists ? 'Edit Photo' : 'Add Photo' }}</h1>
@stop

@section('content')
    <form method="POST" action="{{ $photo->exists ? route('home-photos.update', $photo) : route('home-photos.store') }}" enctype="multipart/form-data">
        @csrf
        @if($photo->exists) @method('PUT') @endif
        <div class="row">
            <div class="col-lg-8">
                <div class="card card-outline card-success">
                    <div class="card-header"><h3 class="card-title">Photo details</h3></div>
                    <div class="card-body">
                        @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
                        <div class="form-group"><label>Title / caption <span class="text-danger">*</span></label><input name="title" class="form-control" value="{{ old('title', $photo->title) }}" required></div>
                        <div class="form-group"><label>Image @if(!$photo->exists)<span class="text-danger">*</span>@endif</label><input type="file" name="image" class="form-control-file" accept="image/jpeg,image/png,image/webp" @if(!$photo->exists) required @endif>@if($photo->exists)<img src="{{ $photo->image_url }}" class="img-thumbnail mt-2" style="max-width:280px">@endif<small class="d-block text-muted mt-1">Landscape works best (e.g. 1200×750). Max 5 MB.</small></div>
                        <div class="form-group"><label>Link (optional)</label><input type="url" name="url" class="form-control" value="{{ old('url', $photo->url) }}" placeholder="https://… news or page the photo should open"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-outline card-success">
                    <div class="card-header"><h3 class="card-title">When to show</h3></div>
                    <div class="card-body">
                        <div class="form-group"><label>Show from</label><input type="date" name="show_from" class="form-control" value="{{ old('show_from', $photo->show_from?->format('Y-m-d')) }}"></div>
                        <div class="form-group"><label>Show until</label><input type="date" name="show_until" class="form-control" value="{{ old('show_until', $photo->show_until?->format('Y-m-d')) }}"><small class="text-muted">Leave both dates empty to show always.</small></div>
                        <div class="form-group"><label>Order</label><input type="number" name="sort_order" class="form-control" min="0" value="{{ old('sort_order', $photo->sort_order ?? 0) }}"><small class="text-muted">Lowest number is the first (featured) photo.</small></div>
                        <div class="custom-control custom-switch"><input type="checkbox" name="is_active" value="1" class="custom-control-input" id="is-active" @checked(old('is_active', $photo->exists ? $photo->is_active : true))><label class="custom-control-label" for="is-active">Active</label></div>
                    </div>
                    <div class="card-footer"><button class="btn btn-success"><i class="fas fa-save mr-1"></i> Save photo</button><a href="{{ route('home-photos.index') }}" class="btn btn-link">Cancel</a></div>
                </div>
            </div>
        </div>
    </form>
@stop

@section('footer') @include('layouts.partials._footer') @stop
