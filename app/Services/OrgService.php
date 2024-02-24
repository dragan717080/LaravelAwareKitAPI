<?php

declare(strict_types = 1);

namespace App\Services;

use App\Repositories\OrgRepository;

use App\Interfaces\{ ReadInterface, DeleteInterface };
use App\Interfaces\Org\{ CreateInterface, UpdateInterface };

use Illuminate\Database\Eloquent\Collection;
use App\Models\Org;

// Interface segregation principles of SOLID
class OrgService implements CreateInterface,
    ReadInterface, UpdateInterface, DeleteInterface
{
    // Property promotion
    public function __construct(private OrgRepository $orgRepository) {}

    public function getAll(): Collection
    {
        return $this->orgRepository->getAll();
    }

    public function getById(string $id): ?Org
    {
        return $this->orgRepository->getById($id);
    }

    public function create(
        string $name, 
        ?string $description, 
        string $type, 
        array $contact, 
        string $creatorId
    ): Org
    {
        return $this->orgRepository->create($name, $description, $type, $contact, $creatorId);
    }

    public function update(
        string $id,
        ?string $name,
        ?string $description,
        ?string $type
    ): ?Org
    {
        return $this->orgRepository->update($id, $name, $description, $type);
    }

    public function delete(string $id): int
    {
        return $this->orgRepository->delete($id);
    }
}
