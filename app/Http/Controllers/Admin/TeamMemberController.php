<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TeamMemberStoreRequest;
use App\Http\Requests\Admin\TeamMemberUpdateRequest;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::get();
        return view('admin.team-member.index', compact('teamMembers'));
    }

    public function create()
    {
        return view('admin.team-member.create');
    }

    public function store(TeamMemberStoreRequest $request)
    {
        $data = $request->validated();

        $data['photo'] = uploadPhoto($request->photo, 'team_members');

        TeamMember::create($data);

        return redirect()->route('team-members.index')->with('success', 'Team Member Created Successfully');
    }

    public function edit($id)
    {
        $teamMember = TeamMember::findOrFail($id);
        return view('admin.team-member.edit', compact('teamMember'));
    }

    public function update(TeamMemberUpdateRequest $request, $id)
    {
        $teamMember = TeamMember::findOrFail($id);

        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = updatePhoto($request->photo, $teamMember, 'team_members');
        }

        $teamMember->update($data);

        return redirect()->route('team-members.index')->with('success', 'Team Member Updated Successfully');
    }

    public function destroy($id)
    {
        $teamMember = TeamMember::findOrFail($id);

        $teamMember->delete();

        return redirect()->route('team-members.index')->with('success', 'Team Member Deleted Successfully');
    }
}