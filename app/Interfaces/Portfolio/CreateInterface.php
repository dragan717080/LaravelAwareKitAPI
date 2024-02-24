<?php

declare(strict_types = 1);

namespace App\Interfaces\Portfolio;

interface CreateInterface 
{
    public function create(string $org_id, string $name, string $owner, array $comms);
}
