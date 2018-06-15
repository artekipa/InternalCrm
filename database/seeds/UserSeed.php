<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Admin', 'firstname' => null, 'lastname' => null, 'phone' => null, 'avatar' => null, 'email' => 'admin@admin.com', 'password' => '$2y$10$WckLVYrGKIkV2BQE43aAY.JYqWcUqoHsRZeszS5StZaYo3EmexOgu', 'created_by_id' => null, 'codenumber' => null, 'remember_token' => '', 'approved' => 1, 'team_id' => null,],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
