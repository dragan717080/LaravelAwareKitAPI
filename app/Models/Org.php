<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Org extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'description', 'type'];

    public function contact()
    {
        return $this->hasOne(Contact::class, 'org_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
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

        return $query->with('creator', 'contact');
    }
}

class Contact extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['email'];

    protected $hidden = ['id', 'org_id'];
    
    public $timestamps = false;

    public function phone()
    {
        return $this->hasOne(Phone::class, 'contact_id');
    }

    /**
     * Override the new query method to include the phone
     * 
     * @param bool $excludeDeleted
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery($excludeDeleted = true)
    {
        $query = parent::newQuery($excludeDeleted);

        return $query->with('phone');
    }
}

class Phone extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['countryCode', 'number'];

    protected $hidden = ['id', 'contact_id'];

    public $timestamps = false;
}
