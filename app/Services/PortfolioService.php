<?php

declare(strict_types = 1);

namespace App\Services;

use App\Repositories\PortfolioRepository;

use App\Interfaces\{ ReadInterface, DeleteInterface };
use App\Interfaces\Portfolio\{ CreateInterface, UpdateInterface };

use Illuminate\Database\Eloquent\Collection;
use App\Models\Portfolio;

// Interface segregation principles of SOLID
class PortfolioService implements CreateInterface,
    ReadInterface, UpdateInterface, DeleteInterface
{
    // Property promotion
    public function __construct(private PortfolioRepository $portfolioRepository) {}

    public function getAll(): Collection
    {
        return $this->portfolioRepository->getAll();
    }

    public function getById(string $id): ?Portfolio
    {
        return $this->portfolioRepository->getById($id);
    }

    public function create(
        string $org_id, string $name, string $owner_id, array $comms
    ): Portfolio
    {
        return $this->portfolioRepository->create($org_id, $name, $owner_id, $comms);
    }

    public function update(
        string $id,
        ?string $name,
        ?string $owner,
        ?array $comms,
    ): ?Portfolio
    {
        return $this->portfolioRepository->update($id, $name, $owner, $comms);
    }

    public function delete(string $id): int
    {
        return $this->portfolioRepository->delete($id);
    }
}
