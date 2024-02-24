<?php

declare(strict_types = 1);

namespace App\Services;

use App\Repositories\UserRepository;

use App\Interfaces\{ ReadInterface, DeleteInterface };
use App\Interfaces\User\{ CreateInterface, UpdateInterface };

use Illuminate\Database\Eloquent\Collection;
use App\Models\User;

// Interface segregation principles of SOLID
class UserService implements CreateInterface,
    ReadInterface, UpdateInterface, DeleteInterface
{
    // Property promotion
    public function __construct(private UserRepository $userRepository) {}

    public function getAll(): Collection
    {
        return $this->userRepository->getAll();
    }

    public function getById(string $id): ?User
    {
        return $this->userRepository->getById($id);
    }

    public function create(string $type, string $context, string $firebaseId, string $email): User
    {
        return $this->userRepository->create($type, $context, $firebaseId, $email);
    }

    public function update(string $id, ?string $email, ?string $password): ?User
    {
        return $this->userRepository->update($id, $email, $password);
    }

    public function delete(string $id): int
    {
        return $this->userRepository->delete($id);
    }
}
