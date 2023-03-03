<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class ThematicImage extends Model
{
    use HasFactory;

    protected $table = 'thematic_images';

    protected $fillable = [
        'position',
        'image_path',
        'title',
        'description'
    ];

    /**
     * Get the thematic that owns this image
     *
     * @return BelongsTo
     */
    public function thematic(): BelongsTo
    {
        return $this->belongsTo(Thematic::class);
    }

    public function saveInPosition()
    {

        if($this->position <= 1) $this->position = 1;
        $max = $this->thematic->thematicImages()->count() + 1;
        if($this->position >= $max) $this->position = $max;

        DB::table($this->table)
            ->where('thematic_id', '=', $this->thematic->id)
            ->where('position', '>=', $this->position)
            ->update(['position' => DB::raw('position + 1')]);

        $this->save();

    }

    public function removeFromPosition()
    {

        DB::table($this->table)
            ->where('thematic_id', '=', $this->thematic->id)
            ->where('position', '>=', $this->position)
            ->update(['position' => DB::raw('position - 1')]);

        $this->delete();
    }

    public function moveUp()
    {

        if ($this->position === 1) return;

        DB::table($this->table)
            ->where('thematic_id', '=', $this->thematic->id)
            ->where('position', '=', $this->position - 1)
            ->update(['position' => $this->position]);

        $this->position = $this->position - 1;
        $this->save();
    }

    public function moveDown()
    {


        if ($this->position === $this->thematic->thematicImages()->count()) return;

        DB::table($this->table)
            ->where('thematic_id', '=', $this->thematic->id)
            ->where('position', '=', $this->position + 1)
            ->update(['position' => $this->position]);

        $this->position = $this->position + 1;
        $this->save();

    }

}
