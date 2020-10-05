<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Workspace;
use App\Community;

class CommunityWorkspaceController extends Controller
{
    public function store(Community $community , Workspace $workspace)
    {
      if (!$community->workspaces->contains($workspace)) {
        $community->workspaces()->save($workspace);
        $community->save();
      }
      else {
        return false;
      }
    }
    public function destroy(Community $community , Workspace $workspace)
    {
      if ($community->workspaces->contains($workspace)) {
        $workspace->community()->dissociate();
        $workspace->save();
      }
      else {
        return false;
      }
    }
}
