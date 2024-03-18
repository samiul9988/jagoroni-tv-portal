<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $title }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">{{ __('title.dashboard') }}</a>
                    </li>
                    @foreach( $addLink as $label => $link )
                        <li class="breadcrumb-item">
                            <a href="{{ $link }}">{{ $label }}</a>
                        </li>
                    @endforeach
                    @isset($currentActive)
                        <li class="breadcrumb-item active">{{ $currentActive }}</li>
                    @endisset
                </ol>
            </div>
        </div>
    </div>
</div>
