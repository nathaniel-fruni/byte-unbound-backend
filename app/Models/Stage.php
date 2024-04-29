<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stage extends Model
{
    use HasFactory;

    protected $table = 'stages';

    protected $fillable = ["name"];

    public function conference(): HasMany
    {
        return $this->hasMany(Conference::class);
    }

    public function talk(): HasMany
    {
        return $this->hasMany(Talk::class);
    }
}
