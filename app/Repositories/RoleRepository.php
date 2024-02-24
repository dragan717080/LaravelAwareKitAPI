<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Traits\{ GetByIdTrait, DeleteTrait };

class RoleRepository
{
    use GetByIdTrait;
    use DeleteTrait;

    public $model;

    public function __construct(
        private UserRepository $userRepository,
        private TeamRepository $teamRepository,
    )
    {
        $this->model = new Role();
    }

    public function getAll()
    {
        return Role::all();
    }
    
    public function update($id, $name, $owner, $members, $comms)
    {
        $role = $this->model->find($id);
    
        if (!$role) {
            return null;
        }
    
        if ($name !== null) {
            $role->name = $name;
        }

        if ($owner !== null) {
            $role->owner_id = $owner;
        }

        if ($members !== null) {
            $role->members = $members;
        }

        if ($comms !== null) {
            $role->comms = json_encode($comms);
        }

        $role->save();

        return $role;
    }

    public function create($team_id, $name, $ownerId, $members, $comms, $iam)
    {
        // Create Role without saving it
        $role = new Role();
        $role->name = $name;
        $userModel = $this->userRepository->getById($ownerId);
        $userModel->team_id = $team_id;
        $userModel->save();

        $role->owner_id = $userModel->id;
        $role->comms = json_encode($comms);
        foreach($members as $member) {
            $userModel = $this->userRepository->getById($member);
            $userModel->team_id = $team_id;
            $userModel->save();
        }

        $role->team_id = $this->teamRepository->getById($team_id)->id;
        $role->iam = json_encode($iam);

        // Save Role to get the id
        $role->save();

        return $role;
    }
}
