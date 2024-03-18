@extends('adminlte::page')

@section('title', __('title.add_new_role'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.add_new_role') }}" currentActive="{{ __('title.add_new_role') }}" :addLink="[__('title.roles') => route('roles.index')]"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <form action="{{ route('roles.store') }}" method="POST" role="form">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{ __('form.name') }}</label>
                            <input type="text" name="name"
                                   class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name"
                                   placeholder="{{ __('form.placeholder_name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @can('add-permissions')
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('title.role_permission') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row" id="checkAllBox">
                                <div class="col-md-12 text-center mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input checkbox" type="checkbox" id="checkAll">
                                        <label for="checkAll" class="custom-control-label font-weight-normal">{{ __('form.check_all') }}</label>
                                    </div>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{ __('table.modules') }}</th>
                                        <th>{{ __('table.actions') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($modules as $module)
                                        <tr>
                                            <td>{{ $module }}</td>
                                            <td>
                                                @foreach ($permissions as $key => $row)
                                                    @if (\App\Helpers\PermissionHelper::getModule($row) == $module)
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input checkbox clickcheckbox" type="checkbox" id="checkbox-{{ $key }}" data-id="{{ $key }}"
                                                                   name="permissions[]" value="{{ $key }}">
                                                            <label for="checkbox-{{ $key }}"
                                                                   class="custom-control-label font-weight-normal">{{ $row }}</label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">{{ __('button.add_new_role') }}</button>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </form>
@stop

@push('js')
    @include('layouts.partials._notification')
    @include('layouts.partials._switch_lang')

    <script>
        "use strict";
        $('#checkAll').change(function() {
            $('#checkAllBox input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop
