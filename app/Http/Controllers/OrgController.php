<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Http\ResponseBuilder;
use App\Services\OrgService;

class OrgController extends BaseController
{
    public function __construct(private OrgService $orgService) {}

    public function getAll() {
        return ResponseBuilder::getResponse(
            fn() => $this->orgService->getAll()
        );
    }

    public function getById($id) {
        return ResponseBuilder::getResponse(
            fn() => $this->orgService->getById($id)
        );
    }

    public function create(Request $req) {
        $org = $req->request->all(); // Convert InputBag to array
        return ResponseBuilder::getResponse(fn() =>
            $this->orgService->create(
                $org['name'],
                $req->input('description'),
                $org['type'],
                $org['contact'],
                $org['creator'],
            )
        );
    }

    public function update($id, Request $req) {
        return ResponseBuilder::getResponse(fn() =>
            $this->orgService->update(
                $id,
                $req->input('name'),
                $req->input('description'),
                $req->input('type'),
            )
        );
    }

    public function delete($id) {
        return ResponseBuilder::getResponse(
            fn() => $this->orgService->delete($id)
        );
    }
}
