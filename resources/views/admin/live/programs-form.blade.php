@extends('adminlte::page')

@section('title', $program->exists ? 'Edit Program' : 'Add Program')

@section('content_header')
    <h1><i class="fas fa-calendar-alt mr-2 text-success"></i>{{ $program->exists ? 'Edit Program' : 'Add Program' }}</h1>
@stop

@section('content')
    <form method="POST" action="{{ $program->exists ? route('live-programs.update', $program) : route('live-programs.store') }}" enctype="multipart/form-data">
        @csrf
        @if($program->exists) @method('PUT') @endif
        <div class="row">
            <div class="col-lg-8">
                <div class="card card-outline card-success">
                    <div class="card-header"><h3 class="card-title">Program details</h3></div>
                    <div class="card-body">
                        @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
                        <div class="form-group"><label>Title <span class="text-danger">*</span></label><input name="title" class="form-control" value="{{ old('title', $program->title) }}" placeholder="দুপুরের সংবাদ" required></div>
                        <div class="form-group"><label>Subtitle</label><input name="subtitle" class="form-control" value="{{ old('subtitle', $program->subtitle) }}" placeholder="সরাসরি সম্প্রচার"></div>
                        <div class="form-group"><label>Description (shown for the current program)</label><textarea name="description" rows="3" class="form-control" maxlength="500">{{ old('description', $program->description) }}</textarea></div>
                        <div class="form-row">
                            <div class="form-group col-md-6"><label>Start time <span class="text-danger">*</span></label><input type="time" name="start_time" class="form-control" value="{{ old('start_time', $program->start_label ?: '') }}" required></div>
                            <div class="form-group col-md-6"><label>End time</label><input type="time" name="end_time" class="form-control" value="{{ old('end_time', $program->end_label) }}"></div>
                        </div>
                        <div class="form-group mb-0"><label>Video link (played when visitors click this program)</label><input type="url" name="video_url" class="form-control" value="{{ old('video_url', $program->video_url) }}" placeholder="https://www.youtube.com/watch?v=… or .mp4 / .m3u8"><small class="text-muted">YouTube, direct .mp4 or .m3u8 links work. Leave empty if there is no video to play.</small></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-outline card-success">
                    <div class="card-header"><h3 class="card-title">Image &amp; publishing</h3></div>
                    <div class="card-body">
                        <div class="form-group"><label>Image (for the featured slider)</label><input type="file" name="image" class="form-control-file" accept="image/jpeg,image/png,image/webp">@if($program->image)<img src="{{ $program->image_url }}" class="img-thumbnail mt-2" style="max-width:200px">@endif<small class="d-block text-muted mt-1">Landscape, e.g. 800×450.</small></div>
                        <div class="form-group"><label>Order</label><input type="number" name="sort_order" class="form-control" min="0" value="{{ old('sort_order', $program->sort_order ?? 0) }}"></div>
                        <div class="custom-control custom-switch mb-2"><input type="checkbox" name="is_featured" value="1" class="custom-control-input" id="is-featured" @checked(old('is_featured', $program->is_featured))><label class="custom-control-label" for="is-featured">Featured (show in slider)</label></div>
                        <div class="custom-control custom-switch"><input type="checkbox" name="is_active" value="1" class="custom-control-input" id="is-active" @checked(old('is_active', $program->exists ? $program->is_active : true))><label class="custom-control-label" for="is-active">Active</label></div>
                    </div>
                    <div class="card-footer"><button class="btn btn-success"><i class="fas fa-save mr-1"></i> Save program</button><a href="{{ route('live-programs.index') }}" class="btn btn-link">Cancel</a></div>
                </div>
            </div>
        </div>
    </form>
@stop

@section('footer') @include('layouts.partials._footer') @stop
