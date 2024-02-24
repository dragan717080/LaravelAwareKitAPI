<?php

declare(strict_types = 1);

namespace App\Interfaces\Org;

interface UpdateInterface
{
    public function update(string $id, ?string $name, ?string $description, ?string $type);
}
