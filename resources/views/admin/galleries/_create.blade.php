<div class="card card-default">
    <form action="{{ route('galleries.store') }}" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="title">{{ __('form.file_title') }}</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                    id="title" placeholder="{{ __('form.placeholder_title') }}" value="{{ old('title') }}" autofocus>
                @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="fileInput">{{ __('form.file_input') }}</label>
                <div class="custom-file">
                    <input type="file" name="file"
                            class="custom-file-input{{ $errors->has('file') ? ' is-invalid' : '' }}" id="inputFile">
                    <label class="custom-file-label" for="fileInput">{{ __('form.placeholder_file_input') }}</label>
                    @error('file')
                    <div class="msg-error-file invalid-feedback">
                        {{ $errors->first('file') }}
                    </div>
                @endif
                </div>
                
            </div>
        </div>
        <div class="card-footer">
            <button id="btn-submit" type="submit" class="btn btn-info float-right">{{ __('button.upload') }}</button>
        </div>
    </form>
</div>
