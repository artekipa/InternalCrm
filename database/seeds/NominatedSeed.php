<?php

use Illuminate\Database\Seeder;

class NominatedSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'company_id' => 1, 'year_id' => 14, 'materialdates' => '', 'docsdate' => '', 'matrialtype' => null, 'materialloc' => null, 'sitenumber' => null, 'contactperson' => null, 'cpemail' => null, 'cpphone' => null, 'presentation_name' => null, 'presentation_site_no' => null, 'member' => 0, 'comments' => null, 'eventpersonno' => 10,],

        ];

        foreach ($items as $item) {
            \App\Nominated::create($item);
        }
    }
}
