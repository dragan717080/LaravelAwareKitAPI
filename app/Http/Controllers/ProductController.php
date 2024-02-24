<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Http\ResponseBuilder;
use App\Services\ProductService;

class ProductController extends BaseController
{
    public function __construct(private ProductService $productService) {}

    public function getAll() {
        return ResponseBuilder::getResponse(fn() =>
            $this->productService->getAll()
        );
    }

    public function getById($org_id, $pfl_id, $id) {
        return ResponseBuilder::getResponse(fn() => 
            $this->productService->getById($id)
        );
    }

    public function create(Request $req, $org_id, $pfl_id) {
        $product = $req->request->all(); // Convert InputBag to array
        return ResponseBuilder::getResponse(fn() =>
            $this->productService->create(
                $pfl_id,
                $product['name'],
                $product['owner'],
                $product['comms']
            )
        );
    }

    public function update($org_id, $pfl_id, $id, Request $req) {
        return ResponseBuilder::getResponse(fn() =>
            $this->productService->update(
                $id,
                $req->input('name'),
                $req->input('owner'),
                $req->input('comms'),
            )
        );
    }

    public function delete($org_id, $pfl_id, $id) {
        return ResponseBuilder::getResponse(
            fn() => $this->productService->delete($id)
        );
    }
}
