<?php

use Illuminate\Database\Seeder;

class VivodeshipSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Dolnośląskie', 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 2, 'name' => 'Kujawsko-pomorskie', 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 3, 'name' => 'Lubelskie', 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 4, 'name' => 'Lubuskie', 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 5, 'name' => 'Łódzkie', 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 6, 'name' => 'Małopolskie', 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 7, 'name' => 'Mazowieckie', 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 8, 'name' => 'Opolskie', 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 9, 'name' => 'Podkarpackie', 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 10, 'name' => 'Podlaskie', 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 11, 'name' => 'Pomorskie', 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 12, 'name' => 'Śląskie', 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 13, 'name' => 'Świętokrzyskie', 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 14, 'name' => 'Warmińsko-mazurskie', 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 15, 'name' => 'Wielkopolskie', 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 16, 'name' => 'Zachodniopomorskie', 'created_by_id' => 1, 'created_by_team_id' => null,],

        ];

        foreach ($items as $item) {
            \App\Vivodeship::create($item);
        }
    }
}
