<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Download extends Model
{
    use HasFactory;

    protected $fillable = ['resource_id'];
    
    public function resources(): BelongsTo
    {
        return $this->belongsTo(Resource::class, 'resource_id', 'id');
    }
}
