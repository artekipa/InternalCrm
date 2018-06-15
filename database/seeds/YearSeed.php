<?php

use Illuminate\Database\Seeder;

class YearSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 2002, 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 2, 'name' => 2003, 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 3, 'name' => 2004, 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 4, 'name' => 2005, 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 5, 'name' => 2006, 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 6, 'name' => 2007, 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 7, 'name' => 2008, 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 8, 'name' => 2009, 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 9, 'name' => 2010, 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 10, 'name' => 2011, 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 11, 'name' => 2012, 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 12, 'name' => 2013, 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 13, 'name' => 2014, 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 14, 'name' => 2015, 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 15, 'name' => 2016, 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 16, 'name' => 2017, 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 17, 'name' => 2018, 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 18, 'name' => 2019, 'created_by_id' => 1, 'created_by_team_id' => null,],
            ['id' => 19, 'name' => 2020, 'created_by_id' => 1, 'created_by_team_id' => null,],

        ];

        foreach ($items as $item) {
            \App\Year::create($item);
        }
    }
}
