<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Coat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function animal(): BelongsToMany
    {
        return $this->belongsToMany(Animal::class, 'animal_coats', 'coat_id', 'animal_id');
    }
}
