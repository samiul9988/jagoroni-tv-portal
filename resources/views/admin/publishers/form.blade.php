@extends('adminlte::page')

@section('title', $publisher->exists ? 'Edit Publisher' : 'Add Publisher')

@section('content_header')
    <h1><i class="fas fa-user-pen mr-2 text-success"></i>{{ $publisher->exists ? 'Edit Publisher' : 'Add Publisher' }}</h1>
@stop

@section('content')
    <form method="POST" action="{{ $publisher->exists ? route('publishers.update', $publisher) : route('publishers.store') }}">
        @csrf
        @if($publisher->exists) @method('PUT') @endif
        <div class="card card-outline card-success">
            <div class="card-body">
                @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
                <div class="form-group"><label>Name <span class="text-danger">*</span></label><input name="name" class="form-control" value="{{ old('name', $publisher->name) }}" required></div>
                <div class="form-group"><label>Location (স্থান)</label><input name="location" class="form-control" value="{{ old('location', $publisher->location) }}" placeholder="ঢাকা"></div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success">Save</button>
                <a href="{{ route('publishers.index') }}" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </form>
@stop

@section('footer') @include('layouts.partials._footer') @stop
