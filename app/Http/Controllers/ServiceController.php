<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Http\ResponseBuilder;
use App\Services\ServiceService;

class ServiceController extends BaseController
{
    public function __construct(private ServiceService $serviceService) {}

    public function getAll() {
        return ResponseBuilder::getResponse(fn() =>
            $this->serviceService->getAll()
        );
    }

    public function getById($org_id, $pfl_id, $prod_id, $id) {
        return ResponseBuilder::getResponse(fn() => 
            $this->serviceService->getById($id)
        );
    }

    public function create(Request $req, $org_id, $pfl_id, $prod_id) {
        $service = $req->request->all(); // Convert InputBag to array
        return ResponseBuilder::getResponse(fn() =>
            $this->serviceService->create(
                $prod_id,
                $service['name'],
                $req->input('parentService'),
                $service['owner'],
                $service['comms']
            )
        );
    }

    public function update($org_id, $pfl_id, $prod_id, $id, Request $req) {
        return ResponseBuilder::getResponse(fn() =>
            $this->serviceService->update(
                $id,
                $req->input('name'),
                $req->input('description'),
                $req->input('type'),
            )
        );
    }

    public function delete($org_id, $pfl_id, $prod_id, $id) {
        return ResponseBuilder::getResponse(
            fn() => $this->serviceService->delete($id)
        );
    }
}
