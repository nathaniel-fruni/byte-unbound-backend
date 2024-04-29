<?php

namespace Database\Seeders;

use App\Models\Testimonal;
use App\Models\Testimonals;
use Illuminate\Database\Seeder;

class AddTestimonals extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonals = [
            [
                'name' => 'Dávid Držík - Doktorand FPVAI UKF',
                'image' => 'drzik_testimonal.jpg',
                'testimonal_text' => 'Oceňujem, že vzniká nová iniciativá spojiť časť akademickej obce v podobe študentov a súkromný sektor v našom regióne',
                'conference_id' => 2,
            ],
            [
                'name' => 'Richard Krupička - Head of recruitment v Synculario',
                'image' => 'krupicka_testimonal.jpg',
                'testimonal_text' => 'Je vždy dobré, keď sa aktivizuje IT komunita aj v oblastaich mimo Bratislavi.',
                'conference_id' => 2,
            ],
            [
                'name' => 'Dávid Frťala - Senior Fullstack Engineer',
                'image' => 'frtala_testimonal.jpg',
                'testimonal_text' => 'Som veľmi rád, že vidím prvé náznaky kreovania aktívnej IT komunity zameranej nie len na B2B formát.',
                'conference_id' => 2,
            ],
            [
                'name' => 'Martin Drlík - Doktorand FPVAI UKF',
                'image' => 'drlik_testimonal.jpg',
                'testimonal_text' => 'Táto konferencia predstavuje vynikajúcu príležitosť pre našich študentov, aby sa nielen zoznámili s najnovšími trendmi v oblasti informatiky, ale aj naviazali cenné kontakty s profesionálmi z praxe.',
                'conference_id' => 2,
            ],
        ];

        foreach ($testimonals as $testimonalData) {
            $testimonal = new Testimonal();
            $testimonal->name = $testimonalData['name'];
            $testimonal->image = $testimonalData['image'];
            $testimonal->testimonal_text = $testimonalData['testimonal_text'];
            $testimonal->conference_id = $testimonalData['conference_id'];
            $testimonal->save();
        }
    }
}
