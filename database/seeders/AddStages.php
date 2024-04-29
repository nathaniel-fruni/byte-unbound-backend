<?php

namespace Database\Seeders;

use App\Models\Stage;
use Illuminate\Database\Seeder;

class AddStages extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stages = ["Soft Dev Stage", "AI & Data Stage"];

        foreach ($stages as $stageName) {
            $stage = new Stage();
            $stage->name = $stageName;
            $stage->save();
        }
    }
}
