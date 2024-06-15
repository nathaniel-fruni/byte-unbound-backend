<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organizer extends Model
{
    use HasFactory;

    protected $table = 'organizers';

    protected $fillable = ["first_name", "last_name", "image", "phone", "email"];

    public function conference(): BelongsToMany
    {
        return $this->belongsToMany(Conference::class, 'conference_organizers');
    }
}
