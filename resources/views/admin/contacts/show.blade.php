@extends('adminlte::page')

@section('title', __('title.detail_message'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.detail_message') }}" currentActive="{{ __('title.detail_message') }}" :addLink="[__('title.contacts') => route('contacts.index')]"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>{{ __('table.name') }}</th>
                            <td>{{ $contact->name }}</td>
                        </tr>
                        <th>{{ __('table.email') }}</th>
                        <td>{{ $contact->email }}</td>
                        <tr>
                            <th>{{ __('table.subject') }}</th>
                            <td>{{ $contact->subject }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('table.message') }}</th>
                            <td>{{ $contact->message }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('table.date_&_time') }}</th>
                            <td>{{ $contact->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@push('js')
    @include('layouts.partials._switch_lang')
@endpush

@section('footer')
@include('layouts.partials._footer')
@stop
