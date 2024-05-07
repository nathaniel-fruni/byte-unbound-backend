<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries';

    protected $fillable = ["name", "conference_id"];

    public function conference(): BelongsTo
    {
        return $this->belongsTo(Conference::class);
    }

    public function gallery_image(): HasMany
    {
        return $this->hasMany(GalleryImage::class);
    }
}
