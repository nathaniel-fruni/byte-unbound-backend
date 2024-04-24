<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Speaker extends Model
{
    use HasFactory;

    protected $table = 'speakers';

    protected $fillable = ["first_name", "last_name", "description", "facebook", "instagram", "linkedin"];

    public function talk(): HasMany
    {
        return $this->hasMany(Talk::class);
    }
}