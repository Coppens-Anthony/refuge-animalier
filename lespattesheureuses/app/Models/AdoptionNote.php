<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdoptionNote extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'adoption_note';

    protected $fillable = [
        'adoption_id',
        'note_id',
    ];

    public function adoption(): BelongsTo
    {
        return $this->belongsTo(Adoption::class);
    }

    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class);
    }
}
