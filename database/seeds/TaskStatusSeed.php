<?php

use Illuminate\Database\Seeder;

class TaskStatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Do zrobienia',],
            ['id' => 2, 'name' => 'W trakcie realizacji',],
            ['id' => 3, 'name' => 'Zrobione',],
            ['id' => 4, 'name' => 'Wstrzymane',],

        ];

        foreach ($items as $item) {
            \App\TaskStatus::create($item);
        }
    }
}
