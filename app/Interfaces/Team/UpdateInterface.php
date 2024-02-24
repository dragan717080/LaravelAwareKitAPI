<?php

declare(strict_types = 1);

namespace App\Interfaces\Team;

interface UpdateInterface
{
    public function update(string $id, ?string $name, ?string $owner, ?array $members, ?array $comms);
}
