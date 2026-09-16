@inject('images', 'App\Helpers\ImageHelper')

<div class="jtv-topbar">
    <div class="container-md d-flex align-items-center justify-content-between">
        <div class="jtv-topbar-left">
            <strong>Jagoroni TV</strong>
            <span class="mx-2">|</span>
            <span>{{ now()->locale(app()->getLocale())->isoFormat('dddd, D MMMM YYYY') }}</span>
        </div>
        @if(!empty($menuHeader))
        <ul class="jtv-topbar-links">
            @foreach(collect($menuHeader)->take(6) as $menu)
                <li><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a></li>
            @endforeach
        </ul>
        @endif
    </div>
</div>

<div class="firstbar">
    <div class="container-md">
        <div class="row">
            <div class="hidden-xs col-lg-3 col-md-4 col-sm-12">
                <div class="brand">
                    <a href="/">
                        <span class="jtv-brand-mark"><span>●</span> Jagoroni<span>TV</span></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-8 col-sm-12">
                <form action="{{ route('search') }}" method="GET" class="search" autocomplete="off">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="{{ __('jagoronitv::magz.type_something_here') }}">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-primary" aria-label="search"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 d-none d-lg-flex align-items-center justify-content-end">
                <span class="jtv-live-pill">LIVE</span>
            </div>
        </div>
    </div>
</div>

<!-- Start nav -->
<x-menu-header :localeId="$localeId"/>
<!-- End nav -->
