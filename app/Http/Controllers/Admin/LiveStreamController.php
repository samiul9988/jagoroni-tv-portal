<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveProgram;
use App\Models\LiveStream;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class LiveStreamController extends Controller
{
    public function edit(): View
    {
        return view('admin.live.stream', [
            'stream' => LiveStream::current(),
            'types' => LiveStream::TYPES,
            'programCount' => LiveProgram::count(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'stream_type' => ['required', Rule::in(array_keys(LiveStream::TYPES))],
            'stream_url' => ['nullable', 'required_unless:stream_type,embed', 'url', 'max:2048'],
            'embed_code' => ['nullable', 'required_if:stream_type,embed', 'string'],
            'poster' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:4096'],
            'viewers_label' => ['nullable', 'string', 'max:50'],
            'youtube_url' => ['nullable', 'url', 'max:2048'],
            'facebook_url' => ['nullable', 'url', 'max:2048'],
            'website_url' => ['nullable', 'url', 'max:2048'],
            'cta_title' => ['nullable', 'string', 'max:150'],
            'cta_text' => ['nullable', 'string', 'max:150'],
        ]);

        $stream = LiveStream::first() ?? new LiveStream();

        unset($data['poster']);
        if ($request->hasFile('poster')) {
            if ($stream->poster) {
                Storage::disk('public')->delete($stream->poster);
            }
            $data['poster'] = $request->file('poster')->store('live', 'public');
        }
        $data['is_live'] = $request->boolean('is_live');

        $stream->fill($data)->save();

        return redirect()->route('live-stream.edit')->withSuccess('Live streaming settings saved.');
    }
}
