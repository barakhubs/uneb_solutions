<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\BelongsToRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class View extends Model
{
    use HasFactory;

    protected $fillable = ['resource_id', 'count'];

    public function resources(): BelongsTo
    {
        return $this->belongsTo(Resource::class, 'resource_id', 'id');
    }
}
