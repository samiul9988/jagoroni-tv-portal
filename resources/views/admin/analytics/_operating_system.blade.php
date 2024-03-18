<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ __('title.operating_system_used_by_users') }}</h3>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('table.operating_system') }}</th>
                    <th>{{ __('table.version') }}</th>
                    <th>{{ __('table.users') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($topOperatingSystem as $i => $v)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $v['os'] }}</td>
                        <td>{{ $v['version'] }}</td>
                        <td>{{ $v['users'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
