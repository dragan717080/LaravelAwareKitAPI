<?php

declare(strict_types = 1);

namespace App\Interfaces\Role;

interface UpdateInterface
{
    public function update(string $id, ?string $name, ?string $owner, ?array $members, ?array $comms);
}
