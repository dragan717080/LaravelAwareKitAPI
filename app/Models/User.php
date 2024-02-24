<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class User extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['firebaseId', 'name', 'alias', 'email', 'type', 'context'];

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
}
