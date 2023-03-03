<?php

namespace Database\Seeders;

use App\Models\Carousel;
use App\Models\CarouselImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**@var Carousel $carousel **/
        $carousel = Carousel::factory()->create([
            'name' => 'Main',
            'page' => 'homepage',
            'position' => 'main',
            'autoplay' => true,
            'fade' => true,
            'controls' => true,
            'interval' => 5,
            'indicators' => false
        ]);

        File::makeDirectory(storage_path('app/public/upload/carousels/'.$carousel->id), 0755, true);

        foreach ([1,2,3,4] as $item) {

            $image = new CarouselImage();
            $image->interval = 0;
            $image->position = $item;
            $image->image_path = 'image-s'.$item.'.jpg';

            $carousel->carouselImages()->save($image);

            File::copy(storage_path('demo_data/carousels/s'.$item.'.jpg'), storage_path('app/public/upload/carousels/'.$carousel->id.'/'.'image-s'.$item.'.jpg'));
        }
    }
}
