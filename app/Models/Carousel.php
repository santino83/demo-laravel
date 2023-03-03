<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Carousel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'page',
        'position',
        'fade',
        'autoplay',
        'interval',
        'indicators',
        'controls'
    ];

    protected $attributes = [
        'fade' => true,
        'autoplay' => true,
        'interval' => 5,
        'indicators' => false,
        'controls' => true
    ];

    protected $casts = [
        'fade' => 'boolean',
        'autoplay' => 'boolean',
        'interval' => 'integer',
        'indicators' => 'boolean',
        'controls' => 'boolean'
    ];

    /**
     * Gets the carousel images
     *
     * @return HasMany
     */
    public function carouselImages(): HasMany
    {
        return $this->hasMany(CarouselImage::class)->orderBy('position', 'asc');
    }

}
