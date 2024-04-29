<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimonal extends Model
{
    use HasFactory;

    protected $table = 'testimonals';

    protected $fillable = ["name", "image", "testimonal_text", "conference_id"];

    public function conference(): BelongsTo
    {
        return $this->belongsTo(Conference::class);
    }
}
