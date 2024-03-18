<ol class="dd-list">
    @foreach( $childs as $child )
        <li class="dd-item" data-id="{{ $child->id }}">
            <div class="dd-handle dd3-handle"></div>
            <div class="dd3-content">
                <span class="label">{{ $child->label }}</span>
                <div class="btn-group float-right" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-xs btn-warning" onclick="event.preventDefault(); edit({{ $child->id }})">{{ __('button.edit') }}</button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="event.preventDefault(); delete({{ $child->id }})"><i class="far fa-trash-alt"></i></button>
                </div>
            </div>
            @if($child->child)
                @include('admin.menu._submenu-item', ['childs' => $child->child])
            @endif
        </li>
    @endforeach
</ol>

