<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries';

    protected $fillable = ["name", "description", "conference_id"];

    public function conference(): BelongsTo
    {
        return $this->belongsTo(Conference::class);
    }
}
