<?php

namespace App\Repositories;

use App\Models\Portfolio;
use App\Repositories\Traits\{ GetByIdTrait, DeleteTrait };

class PortfolioRepository
{
    use GetByIdTrait;
    use DeleteTrait;

    public $model;

    public function __construct(
        private UserRepository $userRepository,
        private OrgRepository $orgRepository,
    )
    {
        $this->model = new Portfolio();
    }

    public function getAll()
    {
        return Portfolio::all();
    }
    
    public function update($id, $name, $owner, $comms)
    {
        $portfolio = $this->model->find($id);
    
        if (!$portfolio) {
            return null;
        }
    
        if ($name !== null) {
            $portfolio->name = $name;
        }

        if ($owner !== null) {
            $portfolio->owner_id = $owner;
        }

        if ($comms !== null) {
            $portfolio->comms = json_encode($comms);
        }

        $portfolio->save();

        return $portfolio;
    }

    public function create($org_id, $name, $ownerId, $comms)
    {
        // Create portfolio without saving it
        $portfolio = new Portfolio();
        $portfolio->name = $name;
        $portfolio->owner_id = $this->userRepository->getById($ownerId)->id;
        $portfolio->comms = json_encode($comms);
        $portfolio->org_id = $this->orgRepository->getById($org_id)->id;

        // Save portfolio to get the id
        $portfolio->save();

        return $portfolio;
    }
}
