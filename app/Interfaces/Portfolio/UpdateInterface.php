<?php

declare(strict_types = 1);

namespace App\Interfaces\Portfolio;

interface UpdateInterface
{
    public function update(string $id, ?string $name, ?string $owner, ?array $comms);
}
