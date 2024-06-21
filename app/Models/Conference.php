<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Conference extends Model
{
    use HasFactory;

    protected $table = 'conferences';

    protected $fillable = ['title', 'short_description', 'long_description', 'info1', 'info2', 'start_date', 'end_date', 'contact_email', 'location_id', 'address_id'];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function organizer(): BelongsToMany
    {
        return $this->belongsToMany(Organizer::class, 'conference_organizers');
    }

    public function partner(): BelongsToMany
    {
        return $this->belongsToMany(Partner::class, 'conference_partners');
    }

    public function sponsor(): BelongsToMany
    {
        return $this->belongsToMany(Sponsor::class, 'conference_sponsors');
    }

    public function testimonal(): HasMany
    {
        return $this->hasMany(Testimonal::class);
    }

    public function gallery(): HasOne
    {
        return $this->hasOne(Gallery::class);
    }

    public function stages(): BelongsToMany
    {
        return $this->belongsToMany(Stage::class, 'conference_stages');
    }

    public function pages(): BelongsToMany
    {
        return $this->belongsToMany(Page::class, 'conference_pages');
    }
}
