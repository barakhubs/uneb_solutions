<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug'];

    /**
     * Get all of the resource for the Classes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function resource(): HasMany
    {
        return $this->hasMany(Resource::class, 'subject_id', 'id');
    }
}
