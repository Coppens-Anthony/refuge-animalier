<?php

namespace App\Models;

use App\Enums\Adoptions;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Adoption extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'status',
        'animal_id',
        'adopter_id',
    ];
    protected $casts = [
        'date' => 'date',
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    public function adopter(): BelongsTo
    {
        return $this->belongsTo(Adopter::class);
    }
    public function formatDate() {
        return Carbon::parse($this->attributes['date'])
            ->isoFormat('D MMMM YYYY');
    }
}
