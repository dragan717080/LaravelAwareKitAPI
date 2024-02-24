<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Service extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'comms'];

    protected $casts = [
        'comms' => 'string',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function getCommsAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * Override the newQuery method to include the creator and contact relationships by default.
     *
     * @param bool $excludeDeleted
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery($excludeDeleted = true)
    {
        $query = parent::newQuery($excludeDeleted);

        return $query->with('owner');
    }
}
