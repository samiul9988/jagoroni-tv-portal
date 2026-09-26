<?php

namespace App\Http\Controllers\Front;

use App\Helpers\SeoHelper;
use App\Http\Controllers\Controller;
use App\Models\LiveProgram;
use App\Models\LiveStream;
use Illuminate\Contracts\View\View;

class LiveController extends Controller
{
    public function __invoke(): View
    {
        $stream = LiveStream::current();
        $programs = LiveProgram::active()->orderBy('start_time')->orderBy('sort_order')->get();
        $now = now()->format('H:i:s');

        $current = $programs->first(fn ($program) => $program->isOnAir($now));
        $upcoming = $current ? null : $programs->first(fn ($program) => (string) $program->start_time > $now);
        $featured = $programs->where('is_featured', true)->values();

        SeoHelper::getPage('video_post', 'লাইভ স্ট্রিমিং - ' . config('settings.site_name'));

        return view('frontend.magz.page.live-tv', compact('stream', 'programs', 'current', 'upcoming', 'featured', 'now'));
    }
}
