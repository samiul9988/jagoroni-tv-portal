@extends('adminlte::page')

@section('title', 'Publishers')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0"><i class="fas fa-user-pen mr-2 text-success"></i>Publishers (প্রকাশক)</h1>
        <a href="{{ route('publishers.create') }}" class="btn btn-success"><i class="fas fa-plus mr-1"></i> Add Publisher</a>
    </div>
@stop

@section('content')
    @include('layouts.partials._notification')
    <div class="card card-outline card-success">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead><tr><th>Name</th><th>Location</th><th class="text-right">Actions</th></tr></thead>
                <tbody>
                @forelse($publishers as $publisher)
                    <tr>
                        <td><strong>{{ $publisher->name }}</strong></td>
                        <td>{{ $publisher->location }}</td>
                        <td class="text-right text-nowrap">
                            <a href="{{ route('publishers.edit', $publisher) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('publishers.destroy', $publisher) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this publisher?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center py-5 text-muted">No publishers added yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if($publishers->hasPages())<div class="card-footer">{{ $publishers->links() }}</div>@endif
    </div>
@stop

@section('footer') @include('layouts.partials._footer') @stop
