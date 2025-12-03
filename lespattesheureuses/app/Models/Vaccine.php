<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vaccine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'species_id',
    ];

    public function animals(): BelongsToMany
    {
        return $this->belongsToMany(Animal::class, 'animal_vaccine', 'vaccine_id', 'animal_id');
    }
}
