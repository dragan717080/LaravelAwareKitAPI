<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Http\ResponseBuilder;
use App\Services\TeamService;

class TeamController extends BaseController
{
    public function __construct(private TeamService $teamService) {}

    public function getAll() {
        return ResponseBuilder::getResponse(fn() =>
            $this->teamService->getAll()
        );
    }

    public function getById($org_id, $id) {
        return ResponseBuilder::getResponse(fn() => 
            $this->teamService->getById($id)
        );
    }

    public function create(Request $req, $org_id) {
        $team = $req->request->all(); // Convert InputBag to array
        return ResponseBuilder::getResponse(fn() =>
            $this->teamService->create(
                $org_id,
                $team['name'],
                $team['owner'],
                $team['comms']
            )
        );
    }

    public function update($org_id, $id, Request $req) {
        return ResponseBuilder::getResponse(fn() =>
            $this->teamService->update(
                $id,
                $req->input('name'),
                $req->input('owner'),
                $req->input('members1'),
                $req->input('comms'),
            )
        );
    }

    public function delete($org_id, $id) {
        return ResponseBuilder::getResponse(
            fn() => $this->teamService->delete($id)
        );
    }
}
