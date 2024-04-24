<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimeSlot extends Model
{
    use HasFactory;

    protected $table = 'time_slots';

    protected $fillable = ["stage_id", "talk_id", "start_time", "end_time"];

    public function stage(): BelongsTo
    {
        return $this->belongsTo(Stage::class);
    }

    public function talk(): BelongsTo
    {
        return $this->belongsTo(Talk::class);
    }
}
