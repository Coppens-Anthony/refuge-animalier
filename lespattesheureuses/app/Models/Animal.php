<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Support\Carbon;

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
    ];

    public function breed(): BelongsTo
    {
        return $this->belongsTo(Breed::class);
    }

    public function specie(): HasOneThrough
    {
        return $this->hasOneThrough(Specie::class, Breed::class, 'id', 'id', 'breed_id', 'specie_id');
    }

    public function vaccine(): BelongsToMany
    {
        return $this->belongsToMany(Vaccine::class, 'animal_vaccines', 'animal_id', 'vaccine_id');
    }

    public function coat(): BelongsToMany
    {
        return $this->belongsToMany(Coat::class, 'animal_coats', 'animal_id', 'coat_id');
    }
}
