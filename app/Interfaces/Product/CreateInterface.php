<?php

declare(strict_types = 1);

namespace App\Interfaces\Product;

interface CreateInterface 
{
    public function create(string $pfl_id, string $name, string $owner, array $comms);
}
