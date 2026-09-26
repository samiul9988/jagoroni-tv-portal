<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TeamMemberController extends Controller
{
    public function index(): View
    {
        return view('admin.team-members.index', [
            'members' => TeamMember::orderByDesc('is_leader')->orderBy('sort_order')->orderBy('id')->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.team-members.form', ['member' => new TeamMember(['is_active' => true])]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['photo'] = $this->storePhoto($request);
        TeamMember::create($data);

        return redirect()->route('team-members.index')->withSuccess('Team member added successfully.');
    }

    public function edit(TeamMember $team_member): View
    {
        return view('admin.team-members.form', ['member' => $team_member]);
    }

    public function update(Request $request, TeamMember $team_member): RedirectResponse
    {
        $data = $this->validated($request);
        if ($photo = $this->storePhoto($request)) {
            $this->deletePhoto($team_member->photo);
            $data['photo'] = $photo;
        }
        $team_member->update($data);

        return redirect()->route('team-members.index')->withSuccess('Team member updated successfully.');
    }

    public function destroy(TeamMember $team_member): RedirectResponse
    {
        $this->deletePhoto($team_member->photo);
        $team_member->delete();

        return redirect()->route('team-members.index')->withSuccess('Team member deleted successfully.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'designation' => ['required', 'string', 'max:150'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:3072'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'quote' => ['nullable', 'string', 'max:500'],
            'education' => ['nullable', 'string', 'max:255'],
            'profession' => ['nullable', 'string', 'max:255'],
            'experience' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'motto' => ['nullable', 'string', 'max:255'],
            'facebook' => ['nullable', 'url', 'max:2048'],
            'twitter' => ['nullable', 'url', 'max:2048'],
            'linkedin' => ['nullable', 'url', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);

        unset($data['photo']);
        $data['is_leader'] = $request->boolean('is_leader');
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        return $data;
    }

    private function storePhoto(Request $request): ?string
    {
        return $request->hasFile('photo') ? $request->file('photo')->store('team', 'public') : null;
    }

    private function deletePhoto(?string $photo): void
    {
        if ($photo) {
            Storage::disk('public')->delete($photo);
        }
    }
}
