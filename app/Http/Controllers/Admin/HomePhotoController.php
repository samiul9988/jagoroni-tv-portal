<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HomePhotoController extends Controller
{
    public function index(): View
    {
        return view('admin.home-photos.index', [
            'photos' => HomePhoto::orderBy('sort_order')->orderByDesc('id')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.home-photos.form', ['photo' => new HomePhoto(['is_active' => true])]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request, true);
        $data['image'] = $request->file('image')->store('home-photos', 'public');
        HomePhoto::create($data);

        return redirect()->route('home-photos.index')->withSuccess('Photo added to the homepage gallery.');
    }

    public function edit(HomePhoto $home_photo): View
    {
        return view('admin.home-photos.form', ['photo' => $home_photo]);
    }

    public function update(Request $request, HomePhoto $home_photo): RedirectResponse
    {
        $data = $this->validated($request, false);
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($home_photo->image);
            $data['image'] = $request->file('image')->store('home-photos', 'public');
        }
        $home_photo->update($data);

        return redirect()->route('home-photos.index')->withSuccess('Photo updated.');
    }

    public function toggle(HomePhoto $home_photo): RedirectResponse
    {
        $home_photo->update(['is_active' => !$home_photo->is_active]);

        return back()->withSuccess($home_photo->is_active ? 'Photo is now shown on the homepage.' : 'Photo hidden from the homepage.');
    }

    public function destroy(HomePhoto $home_photo): RedirectResponse
    {
        Storage::disk('public')->delete($home_photo->image);
        $home_photo->delete();

        return redirect()->route('home-photos.index')->withSuccess('Photo deleted.');
    }

    private function validated(Request $request, bool $imageRequired): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'image' => [$imageRequired ? 'required' : 'nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:5120'],
            'url' => ['nullable', 'url', 'max:2048'],
            'show_from' => ['nullable', 'date'],
            'show_until' => ['nullable', 'date', 'after_or_equal:show_from'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);

        unset($data['image']);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        return $data;
    }
}
