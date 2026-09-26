@extends('adminlte::page')

@section('title', 'Advertisements')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0"><i class="fas fa-bullhorn mr-2 text-success"></i>Advertisements</h1>
        <a href="{{ route('advertisements.create') }}" class="btn btn-success"><i class="fas fa-plus mr-1"></i> New Advertisement</a>
    </div>
@stop

@section('content')
    @include('layouts.partials._notification')
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">Manage ads and placement</h3>
            <div class="card-tools"><span class="badge badge-light">{{ $advertisements->total() }} total</span></div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead><tr><th>Preview</th><th>Name</th><th>Position</th><th>Type</th><th>Order</th><th>Status</th><th class="text-right">Actions</th></tr></thead>
                    <tbody>
                    @forelse($advertisements as $advertisement)
                        <tr>
                            <td style="width:130px">
                                @if($advertisement->type === 'image' && $advertisement->image)
                                    <img src="{{ asset('storage/'.$advertisement->image) }}" alt="{{ $advertisement->name }}" class="img-thumbnail" style="max-width:110px;max-height:55px;object-fit:contain">
                                @else
                                    <span class="badge badge-info"><i class="fas fa-code mr-1"></i> HTML</span>
                                @endif
                            </td>
                            <td><strong>{{ $advertisement->name }}</strong><small class="d-block text-muted">{{ $advertisement->width ?: 'auto' }} × {{ $advertisement->height ?: 'auto' }}</small></td>
                            <td><span class="badge badge-success">{{ $positions[$advertisement->position] ?? $advertisement->position }}</span></td>
                            <td>{{ ucfirst($advertisement->type) }}</td>
                            <td>{{ $advertisement->sort_order }}</td>
                            <td><span class="badge badge-{{ $advertisement->is_active ? 'success' : 'secondary' }}">{{ $advertisement->is_active ? 'Active' : 'Inactive' }}</span></td>
                            <td class="text-right text-nowrap">
                                <a href="{{ route('advertisements.edit', $advertisement) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('advertisements.destroy', $advertisement) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this advertisement?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-5 text-muted">No advertisements created yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($advertisements->hasPages())<div class="card-footer">{{ $advertisements->links() }}</div>@endif
    </div>
@stop

@section('footer') @include('layouts.partials._footer') @stop
