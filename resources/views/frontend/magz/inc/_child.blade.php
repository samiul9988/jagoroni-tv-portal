<ul class="dropdown-menu">
    @foreach( $childs as $child )
    <li class="@if($child['child'])dropdown magz-dropdown @endif">
        <a href="{{ $child['link'] }}" title="">{{ $child['label'] }}@if($child['child'])<i class="arrow-right"></i>@endif</a>

        @if( $child['child'] )
            @include('frontend.magz.inc._child',['childs' => $child['child']])
        @endif

    </li>
    @endforeach
</ul>
