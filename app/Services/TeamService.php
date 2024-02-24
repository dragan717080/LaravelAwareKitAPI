<?php

declare(strict_types = 1);

namespace App\Services;

use App\Repositories\TeamRepository;

use App\Interfaces\{ ReadInterface, DeleteInterface };
use App\Interfaces\Team\{ CreateInterface, UpdateInterface };

use Illuminate\Database\Eloquent\Collection;
use App\Models\Team;

// Interface segregation principles of SOLID
class TeamService implements CreateInterface,
    ReadInterface, UpdateInterface, DeleteInterface
{
    // Property promotion
    public function __construct(private TeamRepository $teamRepository) {}

    public function getAll(): Collection
    {
        return $this->teamRepository->getAll();
    }

    public function getById(string $id): ?Team
    {
        return $this->teamRepository->getById($id);
    }

    public function create(
        string $org_id,
        string $name,
        string $ownerId,
        array $comms
    ): Team
    {
        return $this->teamRepository->create($org_id, $name, $ownerId, $comms);
    }

    public function update(
        string $id,
        ?string $name,
        ?string $owner,
        ?array $members,
        ?array $comms,
    ): ?Team
    {
        return $this->teamRepository->update($id, $name, $owner, $members, $comms);
    }

    public function delete(string $id): int
    {
        return $this->teamRepository->delete($id);
    }
}
