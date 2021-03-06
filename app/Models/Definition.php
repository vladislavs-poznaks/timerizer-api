<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Definition extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'value',
        'description',
    ];

    public function scopeInDictionary(Builder $query, string $title): Builder
    {
        return $query->whereHas('dictionary', function (Builder $query) use ($title) {
            $query->whereTitle($title);
        });
    }

    public function scopeByName(Builder $query, array | string $names): Builder
    {
        return $query->whereIn('name', (array) $names);
    }

    public function scopeByValue(Builder $query, array | string $values): Builder
    {
        return $query->whereIn('value', (array) $values);
    }

    public function dictionary(): BelongsTo
    {
        return $this->belongsTo(Dictionary::class);
    }
}
