<div class="card">
    <div class="card-header d-flex align-items-center">
        <h3 class="card-title mr-auto">{{ __('title.all_tags') }}</h3>
        <div class="card-tools">
            <select name="custom-filter" id="custom-filter" class="form-control input-sm" onChange="$('#tag-table').DataTable().draw();clearBox();changeValLang()"></select>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            {{ $dataTable->table([], true) }}
        </div>
    </div>
</div>
