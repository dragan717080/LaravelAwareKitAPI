<?php

declare(strict_types = 1);

namespace App\Services;

use App\Repositories\ServiceRepository;

use App\Interfaces\{ ReadInterface, DeleteInterface };
use App\Interfaces\Service\{ CreateInterface, UpdateInterface };

use Illuminate\Database\Eloquent\Collection;
use App\Models\Service;

// Interface segregation principles of SOLID
class ServiceService implements CreateInterface,
    ReadInterface, UpdateInterface, DeleteInterface
{
    // Property promotion
    public function __construct(private ServiceRepository $serviceRepository) {}

    public function getAll(): Collection
    {
        return $this->serviceRepository->getAll();
    }

    public function getById(string $id): ?Service
    {
        return $this->serviceRepository->getById($id);
    }

    public function create(
        string $prod_id,
        string $name,
        ?string $parentService,
        string $ownerId,
        array $comms
    ): Service
    {
        return $this->serviceRepository->create($prod_id, $name, $parentService, $ownerId, $comms);
    }

    public function update(
        string $id,
        ?string $name,
        ?string $owner,
        ?array $comms,
    ): ?Service
    {
        return $this->serviceRepository->update($id, $name, $owner, $comms);
    }

    public function delete(string $id): int
    {
        return $this->serviceRepository->delete($id);
    }
}
