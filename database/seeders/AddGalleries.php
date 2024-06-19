<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class AddGalleries extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [
            [
                'name' => '2022',
                'conference_id' => 1,
            ],
            [
                'name' => '2023',
                'conference_id' => 2,
            ],
        ];

        foreach ($galleries as $galleryData) {
            $gallery = new Gallery();
            $gallery->name = $galleryData['name'];
            $gallery->conference_id = $galleryData['conference_id'];
            $gallery->save();
        }
    }
}
