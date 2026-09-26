@extends('adminlte::page')

@section('title', $advertisement->exists ? 'Edit Advertisement' : 'Create Advertisement')

@section('content_header')
    <h1><i class="fas fa-bullhorn mr-2 text-success"></i>{{ $advertisement->exists ? 'Edit Advertisement' : 'Create Advertisement' }}</h1>
@stop

@section('content')
    <form method="POST" action="{{ $advertisement->exists ? route('advertisements.update', $advertisement) : route('advertisements.store') }}" enctype="multipart/form-data">
        @csrf
        @if($advertisement->exists) @method('PUT') @endif
        <div class="row">
            <div class="col-lg-8">
                <div class="card card-outline card-success">
                    <div class="card-header"><h3 class="card-title">Advertisement details</h3></div>
                    <div class="card-body">
                        @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
                        <div class="form-group"><label>Name</label><input name="name" class="form-control" value="{{ old('name', $advertisement->name) }}" required></div>
                        <div class="form-row">
                            <div class="form-group col-md-6"><label>Ad type</label><select name="type" id="ad-type" class="form-control" required>@foreach($types as $key => $label)<option value="{{ $key }}" @selected(old('type', $advertisement->type) === $key)>{{ $label }}</option>@endforeach</select></div>
                            <div class="form-group col-md-6"><label>Position</label><select name="position" class="form-control" required>@foreach($positions as $key => $label)<option value="{{ $key }}" @selected(old('position', $advertisement->position) === $key)>{{ $label }}</option>@endforeach</select></div>
                        </div>
                        <div id="image-fields">
                            <div class="form-group"><label>Image @if(!$advertisement->exists)<span class="text-danger">*</span>@endif</label><input type="file" name="image" class="form-control-file" accept="image/jpeg,image/png,image/webp,image/gif">@if($advertisement->image)<img src="{{ asset('storage/'.$advertisement->image) }}" class="img-thumbnail mt-2" style="max-width:260px;max-height:120px;object-fit:contain">@endif</div>
                            <div class="form-row"><div class="form-group col-md-6"><label>Width (px)</label><input type="number" name="width" class="form-control" value="{{ old('width', $advertisement->width) }}" min="1"></div><div class="form-group col-md-6"><label>Height (px)</label><input type="number" name="height" class="form-control" value="{{ old('height', $advertisement->height) }}" min="1"></div></div>
                            <div class="form-group"><label>Click URL</label><input type="url" name="url" class="form-control" value="{{ old('url', $advertisement->url) }}" placeholder="https://example.com"></div>
                            <div class="form-group"><label>Link target</label><select name="target" class="form-control"><option value="_blank" @selected(old('target', $advertisement->target) === '_blank')>New tab</option><option value="_self" @selected(old('target', $advertisement->target) === '_self')>Same tab</option></select></div>
                        </div>
                        <div id="html-fields" class="form-group"><label>HTML / ad script</label><textarea name="html" class="form-control" rows="8" placeholder="Paste trusted ad HTML or script here">{{ old('html', $advertisement->html) }}</textarea><small class="text-muted">Only add code from a trusted advertising provider.</small></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-outline card-success">
                    <div class="card-header"><h3 class="card-title">Publishing</h3></div>
                    <div class="card-body">
                        <div class="form-group"><label>Display order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $advertisement->sort_order ?? 0) }}" min="0"><small class="text-muted">Lower numbers appear first.</small></div>
                        <div class="custom-control custom-switch mt-3"><input type="checkbox" name="is_active" value="1" class="custom-control-input" id="is-active" @checked(old('is_active', $advertisement->exists ? $advertisement->is_active : true))><label class="custom-control-label" for="is-active">Active on website</label></div>
                    </div>
                    <div class="card-footer"><button class="btn btn-success"><i class="fas fa-save mr-1"></i> Save advertisement</button><a href="{{ route('advertisements.index') }}" class="btn btn-link">Cancel</a></div>
                </div>
            </div>
        </div>
    </form>
@stop

@push('js')
<script>
(function () {
    const type = document.getElementById('ad-type');
    const imageFields = document.getElementById('image-fields');
    const htmlFields = document.getElementById('html-fields');
    function toggle() { const image = type.value === 'image'; imageFields.classList.toggle('d-none', !image); htmlFields.classList.toggle('d-none', image); }
    type.addEventListener('change', toggle); toggle();
})();
</script>
@endpush

@section('footer') @include('layouts.partials._footer') @stop
