<div class="card card-info">
    <div class="card-body">
        <form class="select-menu form-inline" action="{{ route('menusshow') }}" method="POST" role="form">
            @csrf
            <div class="form-group mb-2">
                <label>{{ __('form.menu') }}</label>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <select name="menu" class="form-control">
                    @foreach($menuOptions as $menuid => $name)
                        @if($id == $menuid)
                            <option value="{{ $menuid }}" selected>{{ $name }}</option>
                        @else
                            <option value="{{ $menuid }}">{{ $name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <span class="load-select"></span>
        </form>
    </div>
</div>
