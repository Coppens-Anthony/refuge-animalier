<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vaccine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specie_id',
    ];

    public function specie():BelongsTo
    {
        return $this->belongsTo(Specie::class, 'specie_id');
    }
    public function animal(): BelongsToMany
    {
        return $this->belongsToMany(Animal::class, 'animal_vaccine', 'vaccine_id', 'animal_id');
    }
}
