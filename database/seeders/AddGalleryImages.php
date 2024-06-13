<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use Illuminate\Database\Seeder;

class AddGalleryImages extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            [
                'image' => 'gallery22_01.jpg',
                'gallery_id' => 1,
            ],
            [
                'image' => 'gallery22_02.jpg',
                'gallery_id' => 1,
            ],
            [
                'image' => 'gallery22_03.jpg',
                'gallery_id' => 1,
            ],
            [
                'image' => 'gallery23_01.jpg',
                'gallery_id' => 2,
            ],
            [
                'image' => 'gallery23_02.jpg',
                'gallery_id' => 2,
            ],
            [
                'image' => 'gallery23_03.jpeg',
                'gallery_id' => 2,
            ],
        ];

        foreach ($images as $imageData) {
            $image = new GalleryImage();
            $image->image = $imageData['image'];
            $image->gallery_id = $imageData['gallery_id'];
            $image->save();
        }
    }
}
