<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Http\ResponseBuilder;
use App\Services\RoleService;

class RoleController extends BaseController
{
    public function __construct(private RoleService $roleService) {}

    public function getAll() {
        return ResponseBuilder::getResponse(fn() =>
            $this->roleService->getAll()
        );
    }

    public function getById($org_id, $team_id, $id) {
        return ResponseBuilder::getResponse(fn() => 
            $this->roleService->getById($id)
        );
    }

    public function create(Request $req, $org_id, $team_id) {
        $role = $req->request->all(); // Convert InputBag to array
        return ResponseBuilder::getResponse(fn() =>
            $this->roleService->create(
                $team_id,
                $role['name'],
                $role['owner'],
                $role['members'],
                $role['comms'],
                $role['iam'],
            )
        );
    }

    public function update($org_id, $team_id, $id, Request $req) {
        return ResponseBuilder::getResponse(fn() =>
            $this->roleService->update(
                $id,
                $req->input('name'),
                $req->input('owner'),
                $req->input('members1'),
                $req->input('comms'),
            )
        );
    }

    public function delete($org_id, $team_id, $id) {
        return ResponseBuilder::getResponse(
            fn() => $this->roleService->delete($id)
        );
    }
}
