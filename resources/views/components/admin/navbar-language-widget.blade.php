<li class="nav-item adminlte-language-widget dropdown">
    <a class="nav-link" data-toggle="dropdown" href="javascript:;" aria-expanded="false">
        <span class="d-none d-sm-inline"><i class="flag-icon {{ $flagIcon }}"></i> {{ $languageName }}</span>
        <span class="d-blok d-sm-none text-uppercase"><i class="flag-icon {{ $flagIcon }}"></i></span>
    </a>
    <div class="dropdown-menu dropdown-menu-right p-0">
        @foreach($languages as $language)
            @if($language->name != $languageName)
                <a href="javascript:;" class="dropdown-item setting-language" data-id="{{ $language->id }}">
                    <i class="flag-icon flag-icon-{{ Str::lower($language->country_code) }} mr-2"></i>
                    {{ $language->name }}
                </a>
            @endif
        @endforeach
    </div>
</li>
