@php $currentPublisher = old('publisher_id', ($post ?? null)?->publisher_id); @endphp
<div class="card card-default">
    <div class="card-header"><h3 class="card-title"><i class="fas fa-user-pen mr-1"></i> প্রকাশক</h3></div>
    <div class="card-body">
        <select name="publisher_id" class="form-control">
            <option value="">প্রকাশক নির্বাচন করুন</option>
            @foreach(\App\Models\Publisher::orderBy('name')->get() as $publisher)
                <option value="{{ $publisher->id }}" @selected((string) $currentPublisher === (string) $publisher->id)>{{ $publisher->name }}@if($publisher->location) ({{ $publisher->location }})@endif</option>
            @endforeach
        </select>
    </div>
</div>
