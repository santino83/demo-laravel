<?php

namespace Database\Seeders;

use App\Models\Thematic;
use App\Models\ThematicImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ThematicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /**@var Thematic $thematic **/
        $thematic = Thematic::factory()->create([
            'name' => 'Main',
            'page' => 'homepage',
            'position' => 'main'
        ]);

        File::makeDirectory(storage_path('app/public/upload/thematics/'.$thematic->id), 0755, true);

        $data = [
            1 => ['title' => 'Mare Italia', 'description' => 'Le migliori spiagge italiane Puglia, Sardegna e molto altro'],
            2 => ['title' => 'Adventure', 'description' => 'Una selezione dei nostri pacchetti per chi vuole vivere avventure forti'],
            3 => ['title' => 'Neve', 'description' => 'Per chi ha voglia di sciare e per chi vuole rilassarsi'],
            4 => ['title' => 'Glamping', 'description' => 'Il campeggio di lusso una vacanza diversa ma piena di comfort'],
        ];

        foreach ($data as $item => $value) {
            $image = new ThematicImage();
            $image->position = $item;
            $image->image_path = 'image-t'.$item.'.png';
            $image->title = $value['title'];
            $image->description = $value['description'];

            $thematic->thematicImages()->save($image);

            File::copy(storage_path('demo_data/thematics/t'.$item.'.png'), storage_path('app/public/upload/thematics/'.$thematic->id.'/'.'image-t'.$item.'.png'));

        }


    }
}
