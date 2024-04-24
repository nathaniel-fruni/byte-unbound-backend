<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Talk extends Model
{
    use HasFactory;

    protected $table = 'talks';

    protected $fillable = ["title", "description", "capacity", "speaker_id"];

    public function speaker(): BelongsTo
    {
        return $this->belongsTo(Speaker::class);
    }
}
