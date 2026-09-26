@extends('adminlte::page')

@section('title', 'Live Streaming')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0"><i class="fas fa-broadcast-tower mr-2 text-danger"></i>Live Streaming</h1>
        <a href="{{ url('/live-tv') }}" target="_blank" class="btn btn-outline-success"><i class="fas fa-external-link-alt mr-1"></i> View live page</a>
    </div>
@stop

@section('content')
    @include('layouts.partials._notification')
    <form method="POST" action="{{ route('live-stream.update') }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="row">
            <div class="col-lg-8">
                <div class="card card-outline card-danger">
                    <div class="card-header"><h3 class="card-title">Stream source</h3></div>
                    <div class="card-body">
                        @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
                        <div class="form-group"><label>Player title <span class="text-danger">*</span></label><input name="title" class="form-control" value="{{ old('title', $stream->title ?? 'জাগরণী টিভি লাইভ') }}" required></div>
                        <div class="form-group">
                            <label>Stream type</label>
                            <select name="stream_type" id="stream-type" class="form-control">@foreach($types as $key => $label)<option value="{{ $key }}" @selected(old('stream_type', $stream->stream_type ?: 'youtube') === $key)>{{ $label }}</option>@endforeach</select>
                        </div>
                        <div class="form-group" id="url-field">
                            <label>Stream URL</label>
                            <input type="url" name="stream_url" class="form-control" value="{{ old('stream_url', $stream->stream_url) }}" placeholder="https://www.youtube.com/watch?v=…">
                            <small class="text-muted" id="url-help"></small>
                        </div>
                        <div class="form-group" id="embed-field"><label>Embed code</label><textarea name="embed_code" rows="5" class="form-control" placeholder="<iframe src=&quot;…&quot;></iframe>">{{ old('embed_code', $stream->embed_code) }}</textarea><small class="text-muted">Paste only code from a trusted provider.</small></div>
                        <div class="form-group"><label>Poster image (shown before playback, HLS/MP4)</label><input type="file" name="poster" class="form-control-file" accept="image/jpeg,image/png,image/webp">@if($stream->poster)<img src="{{ $stream->poster_url }}" class="img-thumbnail mt-2" style="max-width:240px">@endif</div>
                    </div>
                </div>

                <div class="card card-outline card-success">
                    <div class="card-header"><h3 class="card-title">"দেখুন যেভাবে" buttons &amp; banner</h3></div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4"><label>YouTube channel URL</label><input type="url" name="youtube_url" class="form-control" value="{{ old('youtube_url', $stream->youtube_url) }}"></div>
                            <div class="form-group col-md-4"><label>Facebook page URL</label><input type="url" name="facebook_url" class="form-control" value="{{ old('facebook_url', $stream->facebook_url) }}"></div>
                            <div class="form-group col-md-4"><label>Website URL</label><input type="url" name="website_url" class="form-control" value="{{ old('website_url', $stream->website_url) }}"></div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6"><label>Banner title</label><input name="cta_title" class="form-control" value="{{ old('cta_title', $stream->cta_title) }}" placeholder="জাগরণী টিভি সরাসরি সম্প্রচার দেখুন"></div>
                            <div class="form-group col-md-6"><label>Banner button text</label><input name="cta_text" class="form-control" value="{{ old('cta_text', $stream->cta_text) }}" placeholder="এখনই দেখুন"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-outline card-danger">
                    <div class="card-header"><h3 class="card-title">Status</h3></div>
                    <div class="card-body">
                        <div class="custom-control custom-switch mb-3"><input type="checkbox" name="is_live" value="1" class="custom-control-input" id="is-live" @checked(old('is_live', $stream->exists ? $stream->is_live : true))><label class="custom-control-label" for="is-live"><b>Live now</b> (turn off when not broadcasting)</label></div>
                        <div class="form-group"><label>Viewers label (optional)</label><input name="viewers_label" class="form-control" value="{{ old('viewers_label', $stream->viewers_label) }}" placeholder="12.4K"><small class="text-muted">Shown next to the LIVE badge.</small></div>
                        <p class="text-muted mb-0"><i class="fas fa-calendar-alt mr-1"></i>{{ $programCount }} program(s) in the schedule. <a href="{{ route('live-programs.index') }}">Manage schedule →</a></p>
                    </div>
                    <div class="card-footer"><button class="btn btn-danger"><i class="fas fa-save mr-1"></i> Save settings</button></div>
                </div>
            </div>
        </div>
    </form>
@stop

@push('js')
<script>
(function () {
    var type = document.getElementById('stream-type'), url = document.getElementById('url-field'), embed = document.getElementById('embed-field'), help = document.getElementById('url-help');
    var tips = {
        youtube: 'Paste the YouTube live or video link (watch, youtu.be, live or embed URL).',
        facebook: 'Paste the public Facebook video / live link.',
        hls: 'Paste the .m3u8 stream address from your streaming server.',
        mp4: 'Paste a direct .mp4 file address.'
    };
    function sync() { var e = type.value === 'embed'; url.classList.toggle('d-none', e); embed.classList.toggle('d-none', !e); help.textContent = tips[type.value] || ''; }
    type.addEventListener('change', sync); sync();
})();
</script>
@endpush

@section('footer') @include('layouts.partials._footer') @stop
