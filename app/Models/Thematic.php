<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Thematic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'page',
        'position'
    ];

    /**
     * Get the images owned by this thematic
     *
     * @return HasMany
     */
    public function thematicImages(): HasMany
    {
        return $this->hasMany(ThematicImage::class)->orderBy('position', 'asc');
    }

}
