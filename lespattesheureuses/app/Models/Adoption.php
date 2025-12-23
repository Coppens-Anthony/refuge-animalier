<?php

namespace App\Models;

use App\Enums\Adoptions;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Adoption extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'status',
        'animal_id',
        'adopter_id',
        'message',
    ];
    protected $casts = [
        'date' => 'date',
        'status' => Adoptions::class
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    public function adopter(): BelongsTo
    {
        return $this->belongsTo(Adopter::class);
    }

    public function formatDate($field): string
    {
        return Carbon::parse($this->attributes[$field])
            ->isoFormat('D MMMM YYYY');
    }

    public function notes(): BelongsToMany
    {
        return $this->belongsToMany(Note::class, 'adoption_note', 'adoption_id', 'note_id');
    }

}
