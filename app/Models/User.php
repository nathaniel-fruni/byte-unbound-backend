<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = ["first_name", "last_name", "email", "password", "role", "remember_token"];

    public function registration(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function talks(): HasManyThrough
    {
        return $this->hasManyThrough(Talk::class, Registration::class);
    }
}
