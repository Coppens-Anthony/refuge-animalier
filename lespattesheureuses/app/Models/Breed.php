<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Breed extends Model
{
    use HasFactory;

    protected $table = 'breeds';

    protected $fillable = [
        'name',
        'specie_id',
    ];

    public function specie(): BelongsTo
    {
        return $this->belongsTo(Specie::class, 'specie_id');
    }
}
