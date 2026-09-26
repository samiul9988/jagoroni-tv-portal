<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publisher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublisherController extends Controller
{
    public function index(): View
    {
        return view('admin.publishers.index', ['publishers' => Publisher::orderBy('name')->paginate(15)]);
    }

    public function create(): View
    {
        return view('admin.publishers.form', ['publisher' => new Publisher()]);
    }

    public function store(Request $request): RedirectResponse
    {
        Publisher::create($this->validated($request));

        return redirect()->route('publishers.index')->withSuccess('Publisher added successfully.');
    }

    public function edit(Publisher $publisher): View
    {
        return view('admin.publishers.form', ['publisher' => $publisher]);
    }

    public function update(Request $request, Publisher $publisher): RedirectResponse
    {
        $publisher->update($this->validated($request));

        return redirect()->route('publishers.index')->withSuccess('Publisher updated successfully.');
    }

    public function destroy(Publisher $publisher): RedirectResponse
    {
        $publisher->posts()->update(['publisher_id' => null]);
        $publisher->delete();

        return redirect()->route('publishers.index')->withSuccess('Publisher deleted successfully.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);
    }
}
