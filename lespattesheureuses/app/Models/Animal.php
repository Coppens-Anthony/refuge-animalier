<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'picture',
        'name',
        'age',
        'sex',
        'coat',
        'temperament',
        'status',
        'species_id',
        'vaccines_id',
    ];

    public function breeds(): BelongsToMany
    {
        return $this->belongsToMany(Breed::class, 'animal_breed', 'animal_id', 'breed_id');
    }

    public function vaccines(): BelongsToMany
    {
        return $this->belongsToMany(Vaccine::class, 'animal_vaccine', 'animal_id', 'vaccine_id');
    }
}
