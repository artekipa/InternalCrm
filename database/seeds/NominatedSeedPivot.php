<?php

use Illuminate\Database\Seeder;

class NominatedSeedPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            1 => [
                'programs_id' => [],
                'project_id' => [],
                'award_id' => [],
                'user_id' => [1],
                'organizations_id' => [],
            ],

        ];

        foreach ($items as $id => $item) {
            $nominated = \App\Nominated::find($id);

            foreach ($item as $key => $ids) {
                $nominated->{$key}()->sync($ids);
            }
        }
    }
}
