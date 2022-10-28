<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tags extends Model
{
    use HasFactory;

    protected $fillable = ['tag', 'slug'];
    
    /**
     * Get all of the resource for the Tags
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function resource(): HasMany
    {
        return $this->hasMany(Resource::class, 'tag_id', 'id');
    }
}
