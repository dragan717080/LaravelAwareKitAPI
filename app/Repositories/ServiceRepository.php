<?php

namespace App\Repositories;

use App\Models\Service;
use App\Repositories\Traits\{ GetByIdTrait, DeleteTrait };

class ServiceRepository
{
    use GetByIdTrait;
    use DeleteTrait;

    public $model;

    public function __construct(
        private UserRepository $userRepository,
        private ProductRepository $productRepository,
    )
    {
        $this->model = new Service();
    }

    public function getAll()
    {
        return Service::all();
    }
    
    public function update($id, $name, $owner, $comms)
    {
        $service = $this->model->find($id);
    
        if (!$service) {
            return null;
        }
    
        if ($name !== null) {
            $service->name = $name;
        }

        if ($owner !== null) {
            $service->owner_id = $owner;
        }

        if ($comms !== null) {
            $service->comms = json_encode($comms);
        }

        $service->save();

        return $service;
    }

    public function create($prod_id, $name, $parentService, $ownerId, $comms)
    {
        $service = new Service();
        $service->name = $name;
        $service->owner_id = $this->userRepository->getById($ownerId)->id;
        $service->comms = json_encode($comms);
        $service->product_id = $this->productRepository->getById($prod_id)->id;

        if ($parentService !== null) {
            $service->parent_service_id = $this->getById($parentService)->id;
        }

        $service->save();

        return $service;
    }
}
