<div class="btn-group btn-group-sm"> 
    @if($reply_btn)
        {!! $reply_btn !!}
    @endif
    @if(Auth::id() === $user_id)
        <button type="button" data-url="{{ $edit_url }}" class="btn btn-warning edit" data-toggle="tooltip" data-placement="top" title="{{ __('button.edit') }}"><i class="fas fa-pencil-alt"></i></button>
    @endif
    @isset($del_url)
        <button type="button" class="btn btn-danger delete" data-url="{{ $del_url }}" data-table="{{ $table }}" data-toggle="tooltip" data-placement="top" title="{{ __('button.delete') }}"><i class="far fa-trash-alt"></i></button>
    @endisset
</div>