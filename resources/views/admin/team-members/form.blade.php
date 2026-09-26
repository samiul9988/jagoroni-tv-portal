@extends('adminlte::page')

@section('title', $member->exists ? 'Edit Team Member' : 'Add Team Member')

@section('content_header')
    <h1><i class="fas fa-users mr-2 text-success"></i>{{ $member->exists ? 'Edit Team Member' : 'Add Team Member' }}</h1>
@stop

@section('content')
    <form method="POST" action="{{ $member->exists ? route('team-members.update', $member) : route('team-members.store') }}" enctype="multipart/form-data">
        @csrf
        @if($member->exists) @method('PUT') @endif
        <div class="row">
            <div class="col-lg-8">
                <div class="card card-outline card-success">
                    <div class="card-header"><h3 class="card-title">Member details</h3></div>
                    <div class="card-body">
                        @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
                        <div class="form-row">
                            <div class="form-group col-md-6"><label>Name <span class="text-danger">*</span></label><input name="name" class="form-control" value="{{ old('name', $member->name) }}" required></div>
                            <div class="form-group col-md-6"><label>Designation <span class="text-danger">*</span></label><input name="designation" class="form-control" value="{{ old('designation', $member->designation) }}" placeholder="সম্পাদক" required></div>
                        </div>
                        <div class="form-group"><label>Short bio</label><textarea name="bio" class="form-control" rows="3" maxlength="1000">{{ old('bio', $member->bio) }}</textarea></div>
                        <div class="form-row">
                            <div class="form-group col-md-4"><label>Facebook URL</label><input type="url" name="facebook" class="form-control" value="{{ old('facebook', $member->facebook) }}"></div>
                            <div class="form-group col-md-4"><label>X (Twitter) URL</label><input type="url" name="twitter" class="form-control" value="{{ old('twitter', $member->twitter) }}"></div>
                            <div class="form-group col-md-4"><label>LinkedIn URL</label><input type="url" name="linkedin" class="form-control" value="{{ old('linkedin', $member->linkedin) }}"></div>
                        </div>
                    </div>
                </div>

                <div class="card card-outline card-warning" id="leader-fields">
                    <div class="card-header"><h3 class="card-title">Leader profile (used only when "Leader / Chairman" is on)</h3></div>
                    <div class="card-body">
                        <div class="form-group"><label>Quote</label><input name="quote" class="form-control" value="{{ old('quote', $member->quote) }}" maxlength="500"></div>
                        <div class="form-row">
                            <div class="form-group col-md-6"><label>Education</label><input name="education" class="form-control" value="{{ old('education', $member->education) }}"></div>
                            <div class="form-group col-md-6"><label>Profession</label><input name="profession" class="form-control" value="{{ old('profession', $member->profession) }}"></div>
                            <div class="form-group col-md-6"><label>Experience</label><input name="experience" class="form-control" value="{{ old('experience', $member->experience) }}"></div>
                            <div class="form-group col-md-6"><label>Location</label><input name="location" class="form-control" value="{{ old('location', $member->location) }}"></div>
                        </div>
                        <div class="form-group mb-0"><label>Motto</label><input name="motto" class="form-control" value="{{ old('motto', $member->motto) }}"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-outline card-success">
                    <div class="card-header"><h3 class="card-title">Photo &amp; publishing</h3></div>
                    <div class="card-body">
                        <div class="form-group"><label>Photo</label><input type="file" name="photo" class="form-control-file" accept="image/jpeg,image/png,image/webp">@if($member->photo)<img src="{{ $member->photo_url }}" class="img-thumbnail mt-2" style="max-width:160px">@endif<small class="d-block text-muted mt-1">Portrait, at least 400×400px.</small></div>
                        <div class="form-group"><label>Display order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $member->sort_order ?? 0) }}" min="0"><small class="text-muted">Lower numbers appear first.</small></div>
                        <div class="custom-control custom-switch mb-2"><input type="checkbox" name="is_leader" value="1" class="custom-control-input" id="is-leader" @checked(old('is_leader', $member->is_leader))><label class="custom-control-label" for="is-leader">Leader / Chairman (featured on top)</label></div>
                        <div class="custom-control custom-switch"><input type="checkbox" name="is_active" value="1" class="custom-control-input" id="is-active" @checked(old('is_active', $member->exists ? $member->is_active : true))><label class="custom-control-label" for="is-active">Show on website</label></div>
                    </div>
                    <div class="card-footer"><button class="btn btn-success"><i class="fas fa-save mr-1"></i> Save member</button><a href="{{ route('team-members.index') }}" class="btn btn-link">Cancel</a></div>
                </div>
            </div>
        </div>
    </form>
@stop

@push('js')
<script>
(function () {
    var toggle = document.getElementById('is-leader'), box = document.getElementById('leader-fields');
    function sync() { box.classList.toggle('d-none', !toggle.checked); }
    toggle.addEventListener('change', sync); sync();
})();
</script>
@endpush

@section('footer') @include('layouts.partials._footer') @stop
