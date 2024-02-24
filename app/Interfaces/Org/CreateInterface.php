<?php

declare(strict_types = 1);

namespace App\Interfaces\Org;

interface CreateInterface 
{
    public function create(string $name, string $description, string $type, array $contact, string $creatorId);
}
