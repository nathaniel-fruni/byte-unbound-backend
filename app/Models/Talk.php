<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Talk extends Model
{
    use HasFactory;

    protected $table = 'talks';

    protected $fillable = ["title", "description", "capacity", "remaining_capacity", "speaker_id"];

    public function speaker(): BelongsTo
    {
        return $this->belongsTo(Speaker::class);
    }

    public function timeSlots(): HasMany
    {
        return $this->hasMany(TimeSlot::class);
    }

    public function stages(): HasManyThrough
    {
        return $this->hasManyThrough(Stage::class, TimeSlot::class);
    }

}
