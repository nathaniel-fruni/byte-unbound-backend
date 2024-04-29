<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partner extends Model
{
    use HasFactory;

    protected $table = 'partners';

    protected $fillable = ["name", "logo", "website"];

    public function conference(): HasMany
    {
        return $this->hasMany(Conference::class);
    }
}
