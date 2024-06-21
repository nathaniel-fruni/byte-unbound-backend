<?php

namespace Database\Seeders;

use App\Models\Conference;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AddConferences extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conferences = [
            [
                'title' => 'nConnect22',
                'short_description' => 'Tech konferencia pre študentov v Žiline',
                'long_description' => 'Po mnohých rokoch premýšľania a plánovania sme vytvorili nConnect, jedinečnú udalosť v Nitre, ktorá spája študentov IT a popredné firmy z tohto dynamického odvetvia. Konferencia nConnect nadväzuje na dlhoročnú tradíciu formátu "IT v praxi" Fakulty prírodných vied a informatiky UKF v Nitre. Táto iniciatíva je mostom medzi novou generáciou talentov a skúsenými profesionálmi, ktorý poskytuje fórum pre vzájomnú výmenu myšlienok a inšpirácií. Naše poslanie bolo jasné: vyplniť medzeru v regionálnej komunikácii a spolupráci v IT a nConnect je hrdým výsledkom tejto vízie.',
                'info1' =>' Sme skupina nadšencov pre IT z akademického a súkromného sektora',
                'info2' => 'Udalosť, ktorá pravidelne spája IT komunitu na Slovensku',
                'start_date' => Carbon::create(2022, 6, 25, 9, 0, 0),
                'end_date' => Carbon::create(2022, 6, 25, 15, 0, 0),
                'registration_deadline' => Carbon::create(2022, 6, 23, 23, 59, 59),
                'contact_email' => 'info@nconnect.sk',
                'location_id' => 3,
                'address_id' => 1
            ],
            [
                'title' => 'nConnect23',
                'short_description' => 'Tech konferencia pre študentov v Bratislave',
                'long_description' => 'Po mnohých rokoch premýšľania a plánovania sme vytvorili nConnect, jedinečnú udalosť v Nitre, ktorá spája študentov IT a popredné firmy z tohto dynamického odvetvia. Konferencia nConnect nadväzuje na dlhoročnú tradíciu formátu "IT v praxi" Fakulty prírodných vied a informatiky UKF v Nitre. Táto iniciatíva je mostom medzi novou generáciou talentov a skúsenými profesionálmi, ktorý poskytuje fórum pre vzájomnú výmenu myšlienok a inšpirácií. Naše poslanie bolo jasné: vyplniť medzeru v regionálnej komunikácii a spolupráci v IT a nConnect je hrdým výsledkom tejto vízie.',
                'info1' =>' Sme skupina nadšencov pre IT z akademického a súkromného sektora',
                'info2' => 'Udalosť, ktorá pravidelne spája IT komunitu na Slovensku',
                'start_date' => Carbon::create(2023, 6, 25, 9, 0, 0),
                'end_date' => Carbon::create(2023, 6, 25, 15, 0, 0),
                'registration_deadline' => Carbon::create(2023, 6, 23, 23, 59, 59),
                'contact_email' => 'info@nconnect.sk',
                'location_id' => 1,
                'address_id' => 2
            ],
            [
                'title' => 'nConnect24',
                'short_description' => 'Tech konferencia pre študentov v Nitre',
                'long_description' => 'Po mnohých rokoch premýšľania a plánovania sme vytvorili nConnect, jedinečnú udalosť v Nitre, ktorá spája študentov IT a popredné firmy z tohto dynamického odvetvia. Konferencia nConnect nadväzuje na dlhoročnú tradíciu formátu "IT v praxi" Fakulty prírodných vied a informatiky UKF v Nitre. Táto iniciatíva je mostom medzi novou generáciou talentov a skúsenými profesionálmi, ktorý poskytuje fórum pre vzájomnú výmenu myšlienok a inšpirácií. Naše poslanie bolo jasné: vyplniť medzeru v regionálnej komunikácii a spolupráci v IT a nConnect je hrdým výsledkom tejto vízie.',
                'info1' =>' Sme skupina nadšencov pre IT z akademického a súkromného sektora',
                'info2' => 'Udalosť, ktorá pravidelne spája IT komunitu na Slovensku',
                'start_date' => Carbon::create(2024, 6, 25, 9, 0, 0),
                'end_date' => Carbon::create(2024, 6, 25, 15, 0, 0),
                'registration_deadline' => Carbon::create(2024, 6, 23, 23, 59, 59),
                'contact_email' => 'info@nconnect.sk',
                'location_id' => 2,
                'address_id' => 3
            ],
        ];

        foreach ($conferences as $conferenceData) {
            $conference = new Conference();
            $conference->title = $conferenceData['title'];
            $conference->short_description = $conferenceData['short_description'];
            $conference->long_description= $conferenceData['long_description'];
            $conference->info1 = $conferenceData['info1'];
            $conference->info2 = $conferenceData['info2'];
            $conference->start_date = $conferenceData['start_date'];
            $conference->end_date = $conferenceData['end_date'];
            $conference->contact_email = $conferenceData['contact_email'];
            $conference->location_id = $conferenceData['location_id'];
            $conference->address_id = $conferenceData['address_id'];
            $conference->save();
        }
    }
}
