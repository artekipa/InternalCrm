<?php

use Illuminate\Database\Seeder;

class RoleSeedPivot extends Seeder
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
                'permission' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 100, 47, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126],
            ],
            2 => [
                'permission' => [27, 32, 33, 34, 35, 37, 38, 39, 40, 36, 42, 43, 44, 45, 48, 49, 50, 51, 53, 54, 55, 56, 58, 59, 60, 61, 47, 63, 64, 65, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 41, 78, 89, 90, 91, 92, 94, 95, 96, 97, 101, 102, 103, 104, 106, 105, 107, 108, 109, 110, 111, 112, 113, 114, 115, 117, 120, 122, 124, 125],
            ],
            3 => [
                'permission' => [12, 14, 15, 27, 37, 38, 39, 40, 41, 32, 33, 34, 35, 36, 48, 49, 50, 51, 53, 54, 55, 56, 58, 59, 60, 61, 63, 64, 65, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 89, 90, 91, 92, 94, 95, 96, 97, 100, 47, 106, 101, 102, 103, 104, 105, 107, 108, 109, 110, 111, 112, 113, 114, 115, 117, 118, 119, 120, 121, 122, 124, 125],
            ],
            4 => [
                'permission' => [27, 37, 38, 39, 40, 22, 23, 24, 25, 26, 32, 33, 34, 35, 36, 12, 13, 14, 15, 16, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 41, 78, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 100, 47, 106, 101, 102, 103, 104, 105, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 79, 80, 81, 82, 83],
            ],

        ];

        foreach ($items as $id => $item) {
            $role = \App\Role::find($id);

            foreach ($item as $key => $ids) {
                $role->{$key}()->sync($ids);
            }
        }
    }
}
