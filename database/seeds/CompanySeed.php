<?php

use Illuminate\Database\Seeder;

class CompanySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'TS Media', 'adress_address' => 'Popas 7, Warszawa, Polska', 'adress_latitude' => 52.1611569, 'adress_longitude' => 20.9381268, 'persontitle' => null, 'personname' => null, 'zipcode' => null, 'city' => null, 'phone' => null, 'email' => null, 'website' => null, 'comments' => null, 'nomination' => null, 'senddate' => '', 'user_id' => 1,],

        ];

        foreach ($items as $item) {
            \App\Company::create($item);
        }
    }
}
