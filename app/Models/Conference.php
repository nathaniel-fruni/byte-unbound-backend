<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Conference extends Model
{
    use HasFactory;

    protected $table = 'conferences';

    protected $fillable = ['title', 'description', 'start_date', 'end_date', 'registration_deadline', 'contact_email', 'location_id', 'address_id'];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
