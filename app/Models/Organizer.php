<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organizer extends Model
{
    use HasFactory;

    protected $table = 'organizers';

    protected $fillable = ["first_name", "last_name", "phone", "email"];

    public function conference(): HasMany
    {
        return $this->hasMany(Conference::class);
    }
}
