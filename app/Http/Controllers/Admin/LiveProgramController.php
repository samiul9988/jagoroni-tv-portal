<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveProgram;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LiveProgramController extends Controller
{
    public function index(): View
    {
        return view('admin.live.programs-index', [
            'programs' => LiveProgram::orderBy('start_time')->orderBy('sort_order')->paginate(30),
            'now' => now()->format('H:i:s'),
        ]);
    }

    public function create(): View
    {
        return view('admin.live.programs-form', ['program' => new LiveProgram(['is_active' => true])]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['image'] = $request->hasFile('image') ? $request->file('image')->store('live-programs', 'public') : null;
        LiveProgram::create($data);

        return redirect()->route('live-programs.index')->withSuccess('Program added.');
    }

    public function edit(LiveProgram $live_program): View
    {
        return view('admin.live.programs-form', ['program' => $live_program]);
    }

    public function update(Request $request, LiveProgram $live_program): RedirectResponse
    {
        $data = $this->validated($request);
        unset($data['image']);
        if ($request->hasFile('image')) {
            if ($live_program->image) {
                Storage::disk('public')->delete($live_program->image);
            }
            $data['image'] = $request->file('image')->store('live-programs', 'public');
        }
        $live_program->update($data);

        return redirect()->route('live-programs.index')->withSuccess('Program updated.');
    }

    public function destroy(LiveProgram $live_program): RedirectResponse
    {
        if ($live_program->image) {
            Storage::disk('public')->delete($live_program->image);
        }
        $live_program->delete();

        return redirect()->route('live-programs.index')->withSuccess('Program deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'subtitle' => ['nullable', 'string', 'max:200'],
            'description' => ['nullable', 'string', 'max:500'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['nullable', 'date_format:H:i'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:4096'],
            'video_url' => ['nullable', 'url', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        return $data;
    }
}
