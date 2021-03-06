<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExerciseType extends Model
{
    use HasFactory, SoftDeletes, Filterable, Uuids;

//    protected static function boot()
//    {
//        static::creating(function ($model) {
//            $model->user_id = auth()->user()->id;
//        });
//
//        parent::boot();
//    }

    protected $fillable = [
        'user_id',
        'name',
        'per_side',
        'url',
    ];

    protected $casts = [
        'per_side' => 'bool'
    ];

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class);
    }
}
