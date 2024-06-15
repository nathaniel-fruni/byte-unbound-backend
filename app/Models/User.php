<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\User as AuthenticatableBase;

class User extends  AuthenticatableBase implements AuthenticatableContract
{
    use HasApiTokens, HasFactory, Notifiable, Authenticatable;

    protected $table = 'users';

    protected $fillable = ["first_name", "last_name", "email", "password", "role", "verification_code"];

    public function registration(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function talks(): HasManyThrough
    {
        return $this->hasManyThrough(Talk::class, Registration::class);
        }
}
