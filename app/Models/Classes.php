<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = ['class', 'slug'];
    
    /**
     * Get all of the resource for the Classes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function resource(): HasMany
    {
        return $this->hasMany(Resource::class, 'class_id', 'id');
    }
}
