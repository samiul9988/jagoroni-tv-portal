<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Contracts\View\View;

class TeamController extends Controller
{
    public function __invoke(): View
    {
        $members = TeamMember::active()->orderBy('sort_order')->orderBy('id')->get();
        $leader = $members->firstWhere('is_leader', true);
        $team = $members->reject(fn ($member) => $leader && $member->id === $leader->id)->values();

        return view('frontend.magz.page.team', compact('leader', 'team'))->with('page', 'team');
    }
}
