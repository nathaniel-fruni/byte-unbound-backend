<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasFactory;

    protected $table = 'pages';

    protected $fillable = ["title", "content"];

    public function conference(): BelongsToMany
    {
        return $this->belongsToMany(Conference::class, 'conference_pages');
    }
}
