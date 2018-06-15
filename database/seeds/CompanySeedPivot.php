<?php

use Illuminate\Database\Seeder;

class CompanySeedPivot extends Seeder
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
                'vivode_id' => [7],
                'trades_id' => [],
                'nomiyear_id' => [],
            ],

        ];

        foreach ($items as $id => $item) {
            $company = \App\Company::find($id);

            foreach ($item as $key => $ids) {
                $company->{$key}()->sync($ids);
            }
        }
    }
}
