@empty($default)
    <input data-code="{{ $code }}" class="toggle-class" name="active" type="checkbox" {{ $checked }} data-toggle="toggle" data-size="sm" data-on="{{ __('button.yes') }}" data-off="{{ __('button.no') }}">
@else
    <input data-code="{{ $code }}" class="toggle-class" name="active" type="checkbox" {{ $checked }} data-toggle="toggle" data-size="sm" data-on="{{ __('button.yes') }}" data-off="{{ __('button.no') }}" disabled>
@endempty
