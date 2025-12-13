<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnimalCoat extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'animal_coats';
    protected $fillable = [
        'animal_id',
        'coat_id',
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    public function coat(): BelongsTo
    {
        return $this->belongsTo(Coat::class);
    }
}
