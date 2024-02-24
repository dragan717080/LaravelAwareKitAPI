<?php

declare(strict_types = 1);

namespace App\Services;

use App\Repositories\ProductRepository;

use App\Interfaces\{ ReadInterface, DeleteInterface };
use App\Interfaces\Product\{ CreateInterface, UpdateInterface };

use Illuminate\Database\Eloquent\Collection;
use App\Models\Product;

// Interface segregation principles of SOLID
class ProductService implements CreateInterface,
    ReadInterface, UpdateInterface, DeleteInterface
{
    // Property promotion
    public function __construct(private ProductRepository $productRepository) {}

    public function getAll(): Collection
    {
        return $this->productRepository->getAll();
    }

    public function getById(string $id): ?Product
    {
        return $this->productRepository->getById($id);
    }

    public function create(
        string $pfl_id, string $name, string $owner_id, array $comms
    ): Product
    {
        return $this->productRepository->create($pfl_id, $name, $owner_id, $comms);
    }

    public function update(
        string $id,
        ?string $name,
        ?string $owner,
        ?array $comms,
    ): ?Product
    {
        return $this->productRepository->update($id, $name, $owner, $comms);
    }

    public function delete(string $id): int
    {
        return $this->productRepository->delete($id);
    }
}
