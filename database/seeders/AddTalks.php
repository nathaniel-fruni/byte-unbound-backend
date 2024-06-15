<?php

namespace Database\Seeders;

use App\Models\Talk;
use Illuminate\Database\Seeder;

class AddTalks extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $talks = [
            [
                'title' => 'Ako sme v Muzikeri postavili miliardový sklad!...dátový',
                'description' => 'Výzva pripraviť sa na dátovú dobu stála aj pred nami v Muzikeri. Ako sme sa s touto výzvou popasovali, čo všetko to znamenalo pre nás, aké všetky prekážky sme museli prekonať, aké všetky veci nás vyfackali vám skusime rozpovedať v našom príbehu. Aby to nebola iba "rozprávka", povieme si viac do detailu o databázovej technologii Clickhouse, ktorá nám veľa z tých problémov pomohla poriešiť. A iné zase priniesla',
                'capacity' => 40,
                'remaining_capacity' => 39,
                'speaker_id' => 7,
            ],
            [
                'title' => 'Data-driven business',
                'description' => 'CEO GymBeam, odhalí, ako dátami riadený prístup a hĺbková analýza ovplyvnili rast jeho spoločnosti a zároveň sa podelí o 5 kritických chýb na ceste k úspechu, ponúkajúc cenné lekcie pre začínajúcich podnikateľov v digitálnom prostredí.',
                'capacity' => 40,
                'remaining_capacity' => 39,
                'speaker_id' => 1,
            ],
            [
                'title' => 'Watsonx - AI riešenie pre business',
                'description' => 'Generatívna umelá inteligencia zažíva v posledných mesiacoch obrovský rozmach. Mnoho ľudí sa domnieva, že tieto modely disponujú neobmedzenými znalosťami. Jan Garček, AI Engineer z IBM Client Engineeringu, predstaví, ako firmy využívajú tieto modely na dosiahnutie svojich cieľov, objasní výhody, ale aj limity tejto technológie, a ukáže, že tieto modely nedokážu vyriešiť všetky naše problémy.',
                'capacity' => 40,
                'remaining_capacity' => 37,
                'speaker_id' => 6,
            ],
            [
                'title' => 'Ako moderné dátové platformy využívajú AI',
                'description' => 'Prieskum inovatívnych spôsobov, akými súčasné technológie a umelá inteligencia (AI) integrované do spracovania a analýzy veľkých objemov dát. Rozoberá kľúčové koncepty, ako sú strojové učenie, hlboké učenie a automatizácia, a ich aplikácie v rámci dátových platform, čím poskytuje účastníkom prehľad o tom, ako AI zvyšuje efektivitu, presnosť a inovácie v oblasti dátových analýz. Prednáška ponúka prípadové štúdie a praktické príklady, ktoré ilustrujú, ako firmy využívajú tieto technológie na zlepšenie rozhodovania a zákazníckej skúsenosti.',
                'capacity' => 40,
                'remaining_capacity' => 39,
                'speaker_id' => 10,
            ],
            [
                'title' => 'Data Mining v Big Data',
                'description' => 'Prehľad o technikách a metódach, ktoré sa využívajú na extrakciu užitočných informácií a vzorcov z rozsiahlych datasetov. Zameriava sa na výzvy spojené s prácou s Big Data, vrátane spracovania, analýzy a zabezpečenia dát. Účastníci sa dozvedia o moderných nástrojoch a algoritmoch používaných v praxi, čím získajú praktické znalosti pre efektívne využívanie dátových zdrojov vo svojich projektoch.',
                'capacity' => 40,
                'remaining_capacity' => 39,
                'speaker_id' => 4,
            ],
            [
                'title' => 'Java Virtual Threads - Je reaktívne programovanie mŕtve?',
                'description' => 'Predstavenie novinky z JAVY JDK 21. Virtualne thready ponukaju uplne inu dimenziu priepustnosti a su jednoduche na spravu. Prinesie tato novinka revoluciu z pohladu rychlosti java aplikacii? Mozeme sa vzdat reactivnej paradigmy v Jave?',
                'capacity' => 40,
                'remaining_capacity' => 39,
                'speaker_id' => 8,
            ],
            [
                'title' => 'Konektivita a integrácia backend systémov s CP4I',
                'description' => 'Technology Engineer v IBM Client Engineering tíme povedie prezentáciu na tému Konektivita a integrácia backend systémov s CP4I. Počas prezentácie sa dozviete, čo sú integrácie a prečo by akákoľvek firma nemala túto tému vynechať. Neoddeliteľnou súčasťou prezentácie budú príklady z reálneho sveta v podaní IBM či ďalších známych firiem.',
                'capacity' => 40,
                'remaining_capacity' => 40,
                'speaker_id' => 5,
            ],
            [
                'title' => 'Štruktúra a spoľahlivosť: Nástroj Lerna v monorepo architektúre',
                'capacity' => 40,
                'remaining_capacity' => 40,
                'description' => 'Téma bude praktickou ukážkou z prostredia firmy Powerplay Studio, kde sme prostredníctvom jednoduchého nástroja Lerna optimalizovali vnútrofiremné procesy vývojárov a sprehľadnili tým náš codebase. Lerna je open-source nástroj na manažovanie monorepa, zabezpečujúci efektívny čas vývoja softvéru bez narušenia robustnosti štruktúry kódu.',
                'speaker_id' => 2,
            ],
            [
                'title' => 'E-commerce architektúra a composable commerce',
                'capacity' => 40,
                'remaining_capacity' => 40,
                'description' => 'Viac ako desať rokov boli v svete e-commerce jasnou voľbou komplexné monolitické systémy, ktoré pokrývali každý aspekt online obchodu. Časy sa ale menia, a posledných pár rokov vidíme príklon k platformám orientovaným na architektúru, ktoré sú navrhnuté s dôrazom na API. Dôležitým princípom sa stáva composable commerce, teda možnosť spájať rôzne produkty do jednej platformy. Firmy sa môžu slobodnejšie rozhodovať, ktoré funkcie nakúpia ako hotové riešenia, do ktorých budú investovať vlastným vývojom - tak aby technológia priniesla najväčší prospech ich zákazníkom.',
                'speaker_id' => 3,
            ],
            [
                'title' => 'Vývoj edukačného softvéru v praxi',
                'capacity' => 40,
                'remaining_capacity' => 39,
                'description' => 'Prednáška poskytne účastníkom hlboký pohľad do procesu vývoja softvéru určeného pre vzdelávací sektor. Zameriame sa na rôzne fázy vývojového cyklu, od počiatočného nápadu a analýzy potrieb, cez návrh a implementáciu, až po testovanie a nasadenie. Zdôrazníme význam používateľsky orientovaného dizajnu, interaktivity a prispôsobenia sa rôznym štýlom učenia.',
                'speaker_id' => 9,
            ],
            [
                'title' => 'Prednáška z roku 2022 (1)',
                'capacity' => 40,
                'remaining_capacity' => 39,
                'description' => 'Popis prednášky z roku 2022 (1)',
                'speaker_id' => 11,
            ],
            [
                'title' => 'Prednáška z roku 2022 (2)',
                'capacity' => 30,
                'remaining_capacity' => 29,
                'description' => 'Popis prednášky z roku 2022 (2)',
                'speaker_id' => 12,
            ],
            [
                'title' => 'Prednáška z roku 2023 (1)',
                'capacity' => 40,
                'remaining_capacity' => 39,
                'description' => 'Popis prednášky z roku 2023 (1)',
                'speaker_id' => 13,
            ],
            [
                'title' => 'Prednáška z roku 2023 (2)',
                'capacity' => 30,
                'remaining_capacity' => 29,
                'description' => 'Popis prednášky z roku 2023 (2)',
                'speaker_id' => 14,
            ]
        ];

        foreach ($talks as $talkData) {
            $talk = new Talk();
            $talk->title = $talkData['title'];
            $talk->description = $talkData['description'];
            $talk->capacity = $talkData['capacity'];
            $talk->remaining_capacity = $talkData['remaining_capacity'];
            $talk->speaker_id = $talkData['speaker_id'];
            $talk->save();
        }
    }
}
