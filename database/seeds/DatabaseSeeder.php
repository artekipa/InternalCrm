<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(PermissionSeed::class);
        $this->call(RoleSeed::class);
        $this->call(TeamSeed::class);
        $this->call(UserSeed::class);
        $this->call(VivodeshipSeed::class);
        $this->call(YearSeed::class);
        $this->call(CompanySeed::class);
        $this->call(NominatedSeed::class);
        $this->call(TaskStatusSeed::class);
        $this->call(CompanySeedPivot::class);
        $this->call(NominatedSeedPivot::class);
        $this->call(RoleSeedPivot::class);
        $this->call(UserSeedPivot::class);

    }
}
