<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Speaker extends Model
{
    use HasFactory;

    protected $table = 'speakers';

    protected $fillable = ["first_name", "last_name", "short_description", "long_description", "picture", "linkedin", "partner_id"];

    public function talk(): HasMany
    {
        return $this->hasMany(Talk::class);
    }

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }
}
