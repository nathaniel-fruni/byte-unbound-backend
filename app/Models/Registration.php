<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends Model
{
    use HasFactory;

    protected $table = 'registrations';

    protected $fillable = ["user_id", "talk_id", "registered_at", "attended"];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function talk(): BelongsTo
    {
        return $this->belongsTo(Talk::class);
    }
}
