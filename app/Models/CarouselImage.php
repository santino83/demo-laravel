<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class CarouselImage extends Model
{
    use HasFactory;

    protected $table = 'carousel_images';

    protected $fillable = [
        'interval',
        'position',
        'image_path',
        'title',
        'description'
    ];

    /**
     * Get the carousel that owns that image
     *
     * @return BelongsTo
     */
    public function carousel(): BelongsTo
    {
        return $this->belongsTo(Carousel::class, 'carousel_id', 'id');
    }

    public function saveInPosition()
    {

        if($this->position <= 1) $this->position = 1;
        $max = $this->carousel->carouselImages()->count() + 1;
        if($this->position >= $max) $this->position = $max;

        DB::table($this->table)
            ->where('carousel_id', '=', $this->carousel->id)
            ->where('position', '>=', $this->position)
            ->update(['position' => DB::raw('position + 1')]);

        $this->save();

    }

    public function removeFromPosition()
    {

        DB::table($this->table)
            ->where('carousel_id', '=', $this->carousel->id)
            ->where('position', '>=', $this->position)
            ->update(['position' => DB::raw('position - 1')]);

        $this->delete();
    }

    public function moveUp()
    {

        if ($this->position === 1) return;

        DB::table($this->table)
            ->where('carousel_id', '=', $this->carousel->id)
            ->where('position', '=', $this->position - 1)
            ->update(['position' => $this->position]);

        $this->position = $this->position - 1;
        $this->save();
    }

    public function moveDown()
    {


        if ($this->position === $this->carousel->carouselImages()->count()) return;

        DB::table($this->table)
            ->where('carousel_id', '=', $this->carousel->id)
            ->where('position', '=', $this->position + 1)
            ->update(['position' => $this->position]);

        $this->position = $this->position + 1;
        $this->save();

    }


}
