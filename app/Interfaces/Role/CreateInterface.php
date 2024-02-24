<?php

declare(strict_types = 1);

namespace App\Interfaces\Role;

interface CreateInterface 
{
    public function create(string $team_id, string $name, string $owner_id, array $members, array $comms, array $iam);
}
