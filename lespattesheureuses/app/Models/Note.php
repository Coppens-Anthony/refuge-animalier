<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function adoptions(): BelongsToMany
    {
        return $this->belongsToMany(Adoption::class, 'adoption_note', 'note_id', 'adoption_id');
    }

    public function formatDate($field): string
    {
        return Carbon::parse($this->attributes[$field])
            ->isoFormat('D-MM-YYYY');
    }
}
