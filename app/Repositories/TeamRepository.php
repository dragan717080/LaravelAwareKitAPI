<?php

namespace App\Repositories;

use App\Models\Team;
use App\Repositories\Traits\{ GetByIdTrait, DeleteTrait };

class TeamRepository
{
    use GetByIdTrait;
    use DeleteTrait;

    public $model;

    public function __construct(
        private UserRepository $userRepository,
        private OrgRepository $orgRepository,
    )
    {
        $this->model = new Team();
    }

    public function getAll()
    {
        return Team::all();
    }
    
    public function update($id, $name, $owner, $members, $comms)
    {
        $team = $this->model->find($id);
    
        if (!$team) {
            return null;
        }
    
        if ($name !== null) {
            $team->name = $name;
        }

        if ($owner !== null) {
            $team->owner_id = $owner;
        }

        if ($members !== null) {
            $team->members = $members;
        }

        if ($comms !== null) {
            $team->comms = json_encode($comms);
        }

        $team->save();

        return $team;
    }

    public function create($org_id, $name, $ownerId, $comms)
    {
        // Create Team without saving it
        $team = new Team();
        $team->name = $name;

        $userModel = $this->userRepository->getById($ownerId);
        $team->owner_id = $userModel->id;
        $team->comms = json_encode($comms);
        $team->org_id = $this->orgRepository->getById($org_id)->id;

        // Save Team to get the id
        $team->save();
        $userModel->team_id = $team->id;
        $userModel->save();

        return $team;
    }
}
