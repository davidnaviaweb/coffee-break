<?php

namespace Database\Seeders;

use App\Models\Allergy;
use Illuminate\Database\Seeder;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Allergy>
 */
class AllergySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allergies = Allergy::getAllergiesFromDir();

        foreach ($allergies as $allergy) {
            Allergy::create($allergy);
        }
    }
}
