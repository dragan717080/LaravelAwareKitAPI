<?php

declare(strict_types = 1);

namespace App\Services;

use App\Repositories\RoleRepository;

use App\Interfaces\{ ReadInterface, DeleteInterface };
use App\Interfaces\Role\{ CreateInterface, UpdateInterface };

use Illuminate\Database\Eloquent\Collection;
use App\Models\Role;

// Interface segregation principles of SOLID
class RoleService implements CreateInterface,
    ReadInterface, UpdateInterface, DeleteInterface
{
    // Property promotion
    public function __construct(private RoleRepository $roleRepository) {}

    public function getAll(): Collection
    {
        return $this->roleRepository->getAll();
    }

    public function getById(string $id): ?Role
    {
        return $this->roleRepository->getById($id);
    }

    public function create(
        string $team_id, 
        string $name, 
        string $owner_id,
        array $members,
        array $comms, 
        array $iam
    ): Role
    {
        return $this->roleRepository->create($team_id, $name, $owner_id, $members, $comms, $iam);
    }

    public function update(
        string $id,
        ?string $name,
        ?string $owner,
        ?array $members,
        ?array $comms,
    ): ?Role
    {
        return $this->roleRepository->update($id, $name, $owner, $members, $comms);
    }

    public function delete(string $id): int
    {
        return $this->roleRepository->delete($id);
    }
}
