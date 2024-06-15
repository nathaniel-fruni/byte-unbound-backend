<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sponsor extends Model
{
    use HasFactory;

    protected $table = 'sponsors';

    protected $fillable = ["name", "logo"];

    public function conference(): BelongsToMany
    {
        return $this->belongsToMany(Conference::class, 'conference_sponsors');
    }
}
