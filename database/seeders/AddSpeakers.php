<?php

namespace Database\Seeders;

use App\Models\Speaker;
use Illuminate\Database\Seeder;

class AddSpeakers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $speakers = [
            [
                'first_name' => 'Dalibor',
                'last_name' => 'Cicman',
                'description' => 'Zakladateľ a CEO GymBeam, od roku 2014 transformoval trh so športovou výživou na e-commerce platformu pôsobiacu v 16 krajinách s ročnými tržbami presahujúcimi 100 miliónov Eur.',
                'picture' => 'cicman.png',
                'linkedin' => 'https://www.linkedin.com/in/dalibor-cicman/'
            ],
            [
                'first_name' => 'Peter',
                'last_name' => 'Pšenák',
                'description' => 'Som programátor so záľubou v JavaScripte a jeho typovo stabilnejšom "mladšom bratovi" TypeScripte. Rád sa zahrám aj s inými jazykmi vrátane Pythonu, R-ka a PHP-čka. Počas mojej niekoľkoročnej kariéry som pôsobil už v spoločnostiach ako Nay alebo PwC.',
                'picture' => 'psenak.jpg',
                'linkedin' => 'https://www.linkedin.com/in/peter-pšenák-3bb441159/'
            ],
            [
                'first_name' => 'Peter',
                'last_name' => 'Urban',
                'description' => 'Za 20 rokov som postupne prešiel od softvérového vývojára k vrcholovému manažmentu v softvérových a e-commerce firmách. Baví ma transformovať zložité biznisové problémy na elegantné softvérové produkty a dokážem zosúladiť obchodnú stratégiu s technológiou.',
                'picture' => 'urban.jpeg',
                'linkedin' => 'https://www.linkedin.com/in/peter-urban/'
            ],
            [
                'first_name' => 'Matúš',
                'last_name' => 'Danóczi',
                'description' => 'Skúsený softvérový inžinier špecializujúci sa na progresívny vývoj softvéru s dôrazom na analýzu veľkých dát.',
                'picture' => 'danoczi.jpeg',
                'linkedin' => 'https://www.linkedin.com/in/danoczim/'
            ],
            [
                'first_name' => 'Tomáš',
                'last_name' => 'Macháň',
                'description' => 'Technology Engineer v IBM Client Engineering, a jeho tím sa špecializujú na optimalizáciu a integráciu backend systémov s využitím Cloud Pak for Integration (CP4I).',
                'picture' => 'machan.jpeg',
                'linkedin' => 'https://www.linkedin.com/in/tomas-machan/'
            ],
            [
                'first_name' => 'Jan',
                'last_name' => 'Garček',
                'description' => 'AI Engineer v tíme IBM Client Engineering, prináša svoje odborné znalosti do sféry generatívnej umelej inteligencie.',
                'picture' => 'garcek.jpeg',
                'linkedin' => 'https://www.linkedin.com/in/jan-garček-174209199/'
            ],
            [
                'first_name' => 'Lukáš',
                'last_name' => 'Kozelnický',
                'description' => 'Lukáš pôsobí v Muzikeri od začiatku roku 2022 a teda od začiatku budovania nového dátového skladu. Deväť rokov sa venoval sieťam a DevOps a od roku 2020 sa viac venuje dátovej vede.',
                'picture' => 'kozelnicky.jpg',
                'linkedin' => null
            ],
            [
                'first_name' => 'Patrik',
                'last_name' => 'Malý',
                'description' => 'Softvérový inžinier s viac ako desaťročnou praxou v oblasti moderného vývoja softvéru v ekosystéme Javy, ktorý sa vyznačuje nielen hlbokými technickými znalosťami, ale aj schopnosťou viesť a inšpirovať tím vývojárov.',
                'picture' => 'kozelnicky.jpg',
                'linkedin' => 'https://www.linkedin.com/in/patrik-malý-69502b10a/'
            ],
            [
                'first_name' => 'Milan',
                'last_name' => 'Moravčík',
                'description' => 'Špecializujem sa na vývoj edukačného softvéru s pozíciou koordinátora pre rozvoj obchodu. Svojou prácou prepojuje technologické inovácie s potrebami vzdelávacích inštitúcií, čím prispievam k vytváraniu interaktívnych a prístupných učebných nástrojov.',
                'picture' => 'moravcik.jpeg',
                'linkedin' => 'https://www.linkedin.com/in/milan-moravčík-45339613a/'
            ],
            [
                'first_name' => 'Vojta',
                'last_name' => 'Tůma',
                'description' => 'Expert na využívanie umelé inteligencie v moderných dátových platformách. Zameriava sa na proces ako AI transformuje spracovanie a analýzu dát, čím umožňuje organizáciám efektívnejšie využívať svoje dátové zdroje.',
                'picture' => 'tuma.jpeg',
                'linkedin' => 'https://www.linkedin.com/in/vojta-tůma-88176460/'
            ]
        ];

        foreach ($speakers as $speakerData) {
            $speaker = new Speaker();
            $speaker->first_name = $speakerData['first_name'];
            $speaker->last_name = $speakerData['last_name'];
            $speaker->description = $speakerData['description'];
            $speaker->picture = $speakerData['picture'];
            $speaker->linkedin = $speakerData['linkedin'];
            $speaker->save();
        }
    }
}
