<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AnimalBreed extends Pivot
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'animal_breed';

    protected $fillable = [
        'animal_id',
        'breed_id',
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    public function breed(): BelongsTo
    {
        return $this->belongsTo(Breed::class);
    }
}
