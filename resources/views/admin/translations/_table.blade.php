<div class="card">
    <div class="card-header d-flex align-items-center">
        <h3 class="card-title mr-auto">{{ __('title.all_translations') }}</h3>
        <div class="card-tools">
            <select name="language-filter" id="language-filter" class="form-control input-sm" onChange="$('#translation-table')"></select>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="input-group">
                    <select name="group-filter" id="group-filter" class="form-control input-sm"></select>
                    <span class="input-group-btn">
                        <a class="btn btn-default btn-flat" href="{{ route('languages.translations.create', $language) }}">Add</a>
                    </span>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <input type="text" id="myInput" placeholder="Search...">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @if(count($translations))
                    <div class="table-responsive">
                        <table id="translation-table" class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="w-1/5 uppercase">Group</th>
                                <th class="uppercase">Key</th>
                                <th class="uppercase">{{ App::currentLocale() }}</th>
                                <th class="uppercase">Translation</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
