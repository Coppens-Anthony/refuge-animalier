<?php

namespace App\Models;

use App\Enums\Sex;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Support\Carbon;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'avatar',
        'name',
        'birthdate',
        'sex',
        'coat',
        'temperament',
        'status',
        'breed_id',
    ];

    protected $casts = [
        'status' => Status::class,
        'sex' => Sex::class,
        'birthdate' => 'date',
        'created_at' => 'datetime',
    ];


    public function breed(): BelongsTo
    {
        return $this->belongsTo(Breed::class);
    }

    public function specie(): HasOneThrough
    {
        return $this->hasOneThrough(Specie::class, Breed::class, 'id', 'id', 'breed_id', 'specie_id');
    }

    public function vaccine(): BelongsToMany
    {
        return $this->belongsToMany(Vaccine::class, 'animal_vaccines', 'animal_id', 'vaccine_id');
    }

    public function coat(): BelongsToMany
    {
        return $this->belongsToMany(Coat::class, 'animal_coats', 'animal_id', 'coat_id');
    }

    public function adoption(): HasMany
    {
        return $this->hasMany(Adoption::class);
    }

    public function age()
    {
        $birthdate = Carbon::parse($this->attributes['birthdate']);
        $now = Carbon::now();
        $years = $birthdate->age;

        if ($years < 1) {
            $months = floor($birthdate->diffInMonths($now));

            if ($months < 1) {
                $days = floor($birthdate->diffInDays($now));
                return $days . ' ' . __('global.days');
            }

            return $months . ' ' . __('global.months');
        }

        return $years . ' ' . __('global.years');
    }
}
