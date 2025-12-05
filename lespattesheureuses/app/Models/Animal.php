<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'avatar',
        'name',
        'age',
        'sex',
        'coat',
        'temperament',
        'status',
        'breed_id',
        //'vaccine_id',
    ];

    public function breed(): BelongsTo
    {
        return $this->belongsTo(Breed::class);
    }

    public function specie(): HasOneThrough
    {
        return $this->hasOneThrough(Specie::class, Breed::class, 'id', 'id', 'breed_id', 'specie_id');
    }
}
