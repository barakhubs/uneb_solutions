<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'class_id',
        'tag_id',
        'subject_id',
        'title',
        'slug',
        'price',
        'description',
        'file',
        'type',
        'size'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tags::class, 'tag_id', 'id');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    /**
     * Get all of the resource for the Classes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function downloads(): HasMany
    {
        return $this->hasMany(Download::class, 'resource_id', 'id');
    }

    /**
     * Get all of the resource for the Classes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function views(): HasOne
    {
        return $this->hasOne(View::class, 'resource_id', 'id');
    }
}
