<?php

use App\Models\Race;
use Illuminate\Database\Seeder;

class RaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Race::create([
            'name' => 'Umano',
            'name_plural' => 'Umani',
            'name_male' => 'Umano',
            'name_female' => 'Umana',
            'active' => true,
            'avaible_registration' => true
        ]);
        Race::create([
            'name' => 'Elfo',
            'name_plural' => 'Elfi',
            'name_male' => 'Elfo',
            'name_female' => 'Elfa',
            'active' => true,
            'avaible_registration' => true
        ]);
    }
}
