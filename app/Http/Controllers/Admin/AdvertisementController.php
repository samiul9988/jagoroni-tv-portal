<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdvertisementController extends Controller
{
    public function index(): View
    {
        return view('admin.advertisements.index', [
            'advertisements' => Advertisement::orderBy('position')->orderBy('sort_order')->orderByDesc('id')->paginate(15),
            'positions' => Advertisement::POSITIONS,
        ]);
    }

    public function create(): View
    {
        return view('admin.advertisements.form', [
            'advertisement' => new Advertisement(['type' => 'image', 'target' => '_blank', 'is_active' => true]),
            'positions' => Advertisement::POSITIONS,
            'types' => Advertisement::TYPES,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['image'] = $this->storeImage($request);
        Advertisement::create($data);

        return redirect()->route('advertisements.index')->withSuccess('Advertisement created successfully.');
    }

    public function edit(Advertisement $advertisement): View
    {
        return view('admin.advertisements.form', [
            'advertisement' => $advertisement,
            'positions' => Advertisement::POSITIONS,
            'types' => Advertisement::TYPES,
        ]);
    }

    public function update(Request $request, Advertisement $advertisement): RedirectResponse
    {
        $data = $this->validated($request);
        if ($data['type'] === 'html') {
            $this->deleteImage($advertisement->image);
        } elseif ($image = $this->storeImage($request)) {
            $this->deleteImage($advertisement->image);
            $data['image'] = $image;
        } else {
            unset($data['image']);
        }
        $advertisement->update($data);

        return redirect()->route('advertisements.index')->withSuccess('Advertisement updated successfully.');
    }

    public function destroy(Advertisement $advertisement): RedirectResponse
    {
        $this->deleteImage($advertisement->image);
        $advertisement->delete();

        return redirect()->route('advertisements.index')->withSuccess('Advertisement deleted successfully.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'type' => ['required', Rule::in(array_keys(Advertisement::TYPES))],
            'position' => ['required', Rule::in(array_keys(Advertisement::POSITIONS))],
            'image' => ['nullable', 'required_if:type,image', 'image', 'mimes:jpeg,jpg,png,webp,gif', 'max:4096'],
            'url' => ['nullable', 'url', 'max:2048'],
            'target' => ['required', Rule::in(['_self', '_blank'])],
            'html' => ['nullable', 'required_if:type,html', 'string'],
            'width' => ['nullable', 'integer', 'min:1', 'max:4000'],
            'height' => ['nullable', 'integer', 'min:1', 'max:4000'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        if ($data['type'] === 'image') {
            $data['html'] = null;
        } else {
            $data['image'] = null;
            $data['url'] = null;
        }

        return $data;
    }

    private function storeImage(Request $request): ?string
    {
        if (!$request->hasFile('image')) {
            return null;
        }

        return $request->file('image')->store('ads', 'public');
    }

    private function deleteImage(?string $image): void
    {
        if ($image) {
            Storage::disk('public')->delete($image);
        }
    }
}
