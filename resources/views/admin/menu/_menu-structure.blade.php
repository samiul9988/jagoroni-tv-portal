<div class="card card-default menuStructure">
    <form>
        <input id="menuid" type="hidden" name="menuid" value="{{ $id }}">
        <div class="card-header d-flex align-items-center">
            <h3 class="card-title mr-auto">{{ __('title.menu_item') }}</h3>
            <div class="card-tools">
                <select id="language" class="form-control" name="language">
                    @foreach($languages as $id => $language)
                        @isset($langId)
                            @if($langId === $id)
                                <option value="{{ $id }}" selected>{{ $language }}</option>
                            @else
                                <option value="{{ $id }}">{{ $language }}</option>
                            @endif
                        @else
                            @if(Languages::showIdLangSession() === $id)
                                <option value="{{ $id }}" selected>{{ $language }}</option>
                            @else
                                <option value="{{ $id }}">{{ $language }}</option>
                            @endif
                        @endisset
                    @endforeach
                </select>
            </div>
        </div>
        <div class="card-body">
            <div class="dd nestable-with-handle">
                <ol id="menulist" class="dd-list"></ol>
            </div>
        </div>
    </form>
</div>
