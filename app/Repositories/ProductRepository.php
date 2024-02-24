<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Traits\{ GetByIdTrait, DeleteTrait };

class ProductRepository
{
    use GetByIdTrait;
    use DeleteTrait;

    public $model;

    public function __construct(
        private UserRepository $userRepository,
        private PortfolioRepository $portfolioRepository,
    )
    {
        $this->model = new Product();
    }

    public function getAll()
    {
        return Product::all();
    }
    
    public function update($id, $name, $owner, $comms)
    {
        $product = $this->model->find($id);
    
        if (!$product) {
            return null;
        }
    
        if ($name !== null) {
            $product->name = $name;
        }

        if ($owner !== null) {
            $product->owner_id = $owner;
        }

        if ($comms !== null) {
            $product->comms = json_encode($comms);
        }

        $product->save();

        return $product;
    }

    public function create($pfl_id, $name, $ownerId, $comms)
    {
        // Create product without saving it
        $product = new Product();
        $product->name = $name;
        $product->owner_id = $this->userRepository->getById($ownerId)->id;
        $product->comms = json_encode($comms);
        $product->pfl_id = $this->portfolioRepository->getById($pfl_id)->id;

        // Save product to get the id
        $product->save();

        return $product;
    }
}
