<?php

declare(strict_types = 1);

namespace App\Interfaces\Service;

interface CreateInterface 
{
    public function create(string $pfl_id, string $name, ?string $parentService, string $owner, array $comms);
}
