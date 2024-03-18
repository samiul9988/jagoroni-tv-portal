@if(isset($menus))
    @foreach($menus as $menu)
        <li class="dd-item dd3-item" data-id="{{ $menu->id }}">
            <div class="dd-handle dd3-handle"></div>
            <div class="dd3-content">
                <span class="label">{{ $menu->label }}</span>
                <div class="btn-group float-right" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-xs btn-warning" onclick="event.preventDefault(); edit({{ $menu->id }})">{{ __('button.edit') }}</button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="event.preventDefault(); remove('{{ route('deleteitemmenu', ['menu_id'=>$id,'id'=>$menu->id]) }}')"><i class="far fa-trash-alt"></i></button>
                </div>
            </div>
            @if($menu->child)
                @include('admin.menu._submenu-item', ['childs' => $menu->child])
            @endif
        </li>
    @endforeach
@endif
