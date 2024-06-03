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
                'short_description' => 'Zakladateľ a CEO GymBeam, od roku 2014 transformoval trh so športovou výživou na e-commerce platformu pôsobiacu v 16 krajinách s ročnými tržbami presahujúcimi 100 miliónov Eur.',
                'long_description' => 'Ako nositeľ ocenení Forbes "30 pod 30" a YT Podnikateľ roka 2024, Dalibor presadzuje význam dátovo riadeného prístupu, inovačnej kultúry a tímovej spolupráce pri budovaní značky.',
                'picture' => 'cicman.png',
                'linkedin' => 'https://www.linkedin.com/in/dalibor-cicman/',
                'partner_id' => 4
            ],
            [
                'first_name' => 'Peter',
                'last_name' => 'Pšenák',
                'short_description' => 'Som programátor so záľubou v JavaScripte a jeho typovo stabilnejšom "mladšom bratovi" TypeScripte. Rád sa zahrám aj s inými jazykmi vrátane Pythonu, R-ka a PHP-čka. Počas mojej niekoľkoročnej kariéry som pôsobil už v spoločnostiach ako Nay alebo PwC.',
                'long_description' => 'Aktuálne pôsobím ako technický riaditeľ spoločnosti Powerplay Studio, kde spríjemňujem život mojich programátorských kolegov mojimi "jednoduchými" zadaniami. Vo voľnom čase... programujem.',
                'picture' => 'psenak.jpg',
                'linkedin' => 'https://www.linkedin.com/in/peter-pšenák-3bb441159/',
                'partner_id' => 2
            ],
            [
                'first_name' => 'Peter',
                'last_name' => 'Urban',
                'short_description' => 'Za 20 rokov som postupne prešiel od softvérového vývojára k vrcholovému manažmentu v softvérových a e-commerce firmách. Baví ma transformovať zložité biznisové problémy na elegantné softvérové produkty a dokážem zosúladiť obchodnú stratégiu s technológiou.',
                'long_description' => 'Mám zvyčajne na starosti technickú víziu a smerovanie veľkých spoločností, ale spoluzakladal som aj startupový inkubačný program v Košiciach. Budem rozprávať o e-commerce, keďže som CTO Dedolesu, predtým som bol tri roky CTO GymBeam-u.',
                'picture' => 'urban.jpeg',
                'linkedin' => 'https://www.linkedin.com/in/peter-urban/',
                'partner_id' => 7
            ],
            [
                'first_name' => 'Matúš',
                'last_name' => 'Danóczi',
                'short_description' => 'Skúsený softvérový inžinier špecializujúci sa na progresívny vývoj softvéru s dôrazom na analýzu veľkých dát.',
                'long_description' => 'Momentálne vedie tím vývojárov v spoločnosti Muehlbauer, kde má na starosti manažment tímu, strategické plánovanie projektov a zavádzanie inovatívnych technologických riešení.',
                'picture' => 'danoczi.jpeg',
                'linkedin' => 'https://www.linkedin.com/in/danoczim/',
                'partner_id' => 3
            ],
            [
                'first_name' => 'Tomáš',
                'last_name' => 'Macháň',
                'short_description' => 'Technology Engineer v IBM Client Engineering, a jeho tím sa špecializujú na optimalizáciu a integráciu backend systémov s využitím Cloud Pak for Integration (CP4I).',
                'long_description' => 'Ich práca je zameraná na poskytovanie efektívnych riešení pre spojenie rôznych systémov a aplikácií, čím umožňujú firmám lepšie využívať ich dátové zdroje a zvyšovať ich operatívnu efektivitu. S príkladmi z reálneho sveta od IBM a ďalších známych spoločností Tomáš a jeho tím ukazujú dôležitosť integrácií v dnešnom digitálnom svete.',
                'picture' => 'machan.jpeg',
                'linkedin' => 'https://www.linkedin.com/in/tomas-machan/',
                'partner_id' => 9
            ],
            [
                'first_name' => 'Jan',
                'last_name' => 'Garček',
                'short_description' => 'AI Engineer v tíme IBM Client Engineering, prináša svoje odborné znalosti do sféry generatívnej umelej inteligencie.',
                'long_description' => 'S jeho tímom, ktorý pomáha klientom pri digitálnej transformácii prostredníctvom spolupráce, navrhovania a implementácie riešení využívajúcich pokročilé technológie IBM, sa Jan zameriava na využívanie AI modelov k dosiahnutiu cieľov klientov.',
                'picture' => 'garcek.jpeg',
                'linkedin' => 'https://www.linkedin.com/in/jan-garček-174209199/',
                'partner_id' => 9
            ],
            [
                'first_name' => 'Lukáš',
                'last_name' => 'Kozelnický',
                'short_description' => 'Lukáš pôsobí v Muzikeri od začiatku roku 2022 a teda od začiatku budovania nového dátového skladu. Deväť rokov sa venoval sieťam a DevOps a od roku 2020 sa viac venuje dátovej vede.',
                'long_description' => 'Má skúsenosti s technológiami ako Python, Airflow, DBT či ClickHouse.',
                'picture' => 'kozelnicky.jpg',
                'linkedin' => null,
                'partner_id' => 6
            ],
            [
                'first_name' => 'Patrik',
                'last_name' => 'Malý',
                'short_description' => 'Softvérový inžinier s viac ako desaťročnou praxou v oblasti moderného vývoja softvéru v ekosystéme Javy, ktorý sa vyznačuje nielen hlbokými technickými znalosťami, ale aj schopnosťou viesť a inšpirovať tím vývojárov.',
                'long_description' => 'Aktuálne zastáva pozíciu vedúceho skupiny vývojárov v spoločnosti UNIQA GSC Slovensko, kde je zodpovedný za riadenie tímu, strategické plánovanie projektov a implementáciu nových technologických riešení.',
                'picture' => 'maly.jpg',
                'linkedin' => 'https://www.linkedin.com/in/patrik-malý-69502b10a/',
                'partner_id' => 1
            ],
            [
                'first_name' => 'Milan',
                'last_name' => 'Moravčík',
                'short_description' => 'Špecializujem sa na vývoj edukačného softvéru s pozíciou koordinátora pre rozvoj obchodu. Svojou prácou prepojuje technologické inovácie s potrebami vzdelávacích inštitúcií, čím prispievam k vytváraniu interaktívnych a prístupných učebných nástrojov.',
                'long_description' => 'Zameriavam sa na rozvoj obchodných stratégií a partnerstiev čo umožňuje efektívne nasadenie edukačných technológií a zlepšovanie učebných výsledkov na rôznych úrovniach vzdelávania.',
                'picture' => 'moravcik.jpeg',
                'linkedin' => 'https://www.linkedin.com/in/milan-moravčík-45339613a/',
                'partner_id' => 8
            ],
            [
                'first_name' => 'Vojta',
                'last_name' => 'Tůma',
                'short_description' => 'Expert na využívanie umelé inteligencie v moderných dátových platformách. Zameriava sa na proces ako AI transformuje spracovanie a analýzu dát, čím umožňuje organizáciám efektívnejšie využívať svoje dátové zdroje.',
                'long_description' => 'Venujem sa najnovším trendom v AI, ako sú strojové učenie a hlboké učenie, a ich aplikáciách v dátových platformách pre prediktívnu analýzu, automatizáciu a personalizáciu služieb.',
                'picture' => 'tuma.jpeg',
                'linkedin' => 'https://www.linkedin.com/in/vojta-tůma-88176460/',
                'partner_id' => 5
            ]
        ];

        foreach ($speakers as $speakerData) {
            $speaker = new Speaker();
            $speaker->first_name = $speakerData['first_name'];
            $speaker->last_name = $speakerData['last_name'];
            $speaker->short_description = $speakerData['short_description'];
            $speaker->long_description = $speakerData['long_description'];
            $speaker->picture = $speakerData['picture'];
            $speaker->linkedin = $speakerData['linkedin'];
            $speaker->partner_id = $speakerData['partner_id'];
            $speaker->save();
        }
    }
}
