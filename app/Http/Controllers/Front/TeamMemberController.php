<?php

namespace App\Http\Controllers\Front;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamMemberController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::paginate(20);
        return view('front.team-members', compact('teamMembers'));
    }

    public function show($slug)
    {
        $teamMember = TeamMember::where('slug', $slug)->first();
        return view('front.team-member', compact('teamMember'));
    }
}
