<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    protected $fillable = ["building", "street", "number", "phone", "postal_code", "city"];

    public function conference(): HasMany
    {
        return $this->hasMany(Conference::class);
    }
}
