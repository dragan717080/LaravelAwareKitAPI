<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Http\ResponseBuilder;
use App\Services\PortfolioService;

class PortfolioController extends BaseController
{
    public function __construct(private PortfolioService $portfolioService) {}

    public function getAll() {
        return ResponseBuilder::getResponse(fn() =>
            $this->portfolioService->getAll()
        );
    }

    // Also need to specify previous slug
    public function getById($_, $id) {
        return ResponseBuilder::getResponse(fn() => 
            $this->portfolioService->getById($id)
        );
    }

    public function create(Request $req, $org_id) {
        $portfolio = $req->request->all(); // Convert InputBag to array
        return ResponseBuilder::getResponse(fn() =>
            $this->portfolioService->create(
                $org_id,
                $portfolio['name'],
                $portfolio['owner'],
                $portfolio['comms']
            )
        );
    }

    public function update($_, $id, Request $req) {
        return ResponseBuilder::getResponse(fn() =>
            $this->portfolioService->update(
                $id,
                $req->input('name'),
                $req->input('description'),
                $req->input('type'),
            )
        );
    }

    public function delete($_, $id) {
        return ResponseBuilder::getResponse(
            fn() => $this->portfolioService->delete($id)
        );
    }
}
