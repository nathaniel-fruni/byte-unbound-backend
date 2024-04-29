<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class AddPartners extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'name' => 'UNIQA GSC Slovensko',
                'logo' => 'uniqua_logo.png',
                'website' => 'https://www.uniqa.sk'
            ],
            [
                'name' => 'PowerPlay Studio',
                'logo' => 'powerplaystudio.png',
                'website' => 'https://www.powerplay.studio/sk'
            ],
            [
                'name' => 'Muehlbauer',
                'logo' => 'muehlbauer_logo.png',
                'website' => 'https://muehlbauer.de//'
            ],
            [
                'name' => 'GymBeam',
                'logo' => 'gymbeam_logo.jpg',
                'website' => 'https://gymbeam.sk'
            ],
            [
                'name' => 'Keebola',
                'logo' => 'keebola_logo.png',
                'website' => 'https://www.keboola.com'
            ],
            [
                'name' => 'Muziker',
                'logo' => 'muziker_logo.png',
                'website' => 'https://www.muziker.sk'
            ],
            [
                'name' => 'Dedoles',
                'logo' => 'dedoles_logo.png',
                'website' => 'https://www.dedoles.sk'
            ],
            [
                'name' => 'Edix',
                'logo' => 'edix.logo.png',
                'website' => 'https://www.edix.sk'
            ],
            [
                'name' => 'IBM',
                'logo' => 'ibm_logo.jpg'    ,
                'website' => 'https://www.ibm.com/us-en'
            ],
        ];

        foreach ($partners as $partnerData) {
            $partner = new Partner();
            $partner->name = $partnerData['name'];
            $partner->logo = $partnerData['logo'];
            $partner->website = $partnerData['website'];
            $partner->save();
        }
    }
}
