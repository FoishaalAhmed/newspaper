<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamRequest;
use App\Models\Team;

class TeamController extends Controller
{
    private $teamObject;

    public function __construct()
    {
        $this->teamObject = new Team();
    }

    public function index()
    {
        $teams = Team::orderBy('priority', 'desc')->get();
        return view('backend.admin.teams.index', compact('teams'));
    }

    public function create()
    {
        return view('backend.admin.teams.create');
    }

    public function store(TeamRequest $request)
    {
        $this->teamObject->storeTeam($request);
        return back();
    }

    public function edit($id)
    {
        $team = Team::findOrFail($id);
        return view('backend.admin.teams.edit', compact('team'));
    }

    public function update(TeamRequest $request, $id)
    {
        $this->teamObject->updateTeam($request, $id);
        return redirect()->route('admin.teams.index');
    }

    public function destroy($id)
    {
        $this->teamObject->destroyTeam($id);
        return back();
    }
}
