<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AddLocations::class,
            AddConferences::class,
            AddOrganizers::class,
            AddConferenceOrganizers::class,
            AddPartners::class,
            AddConferencePartners::class,
            AddSponsors::class,
            AddConferenceSponsors::class,
            AddTestimonals::class,
            AddGalleries::class,
            AddGalleryImages::class,
            AddSpeakers::class,
            AddSpeakerPartners::class,
            AddTalks::class,
            AddStages::class,
            AddTimeSlots::class,
            AddConferenceStages::class,
            AddUsers::class,
            AddRegistrations::class
        ]);
    }
}
