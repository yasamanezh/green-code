<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role=Role::create( [
            'id'=>1,
            'name'=>'دمو',
            'label'=>'دمو نمایشی',
            'created_at'=>'2022-06-05 14:27:52',
            'updated_at'=>'2022-06-05 14:27:52'
        ]);
        $role->permissions()->sync([3,4,7,6,10,13,16,19,22,25,28,31,34,37,41,44,47,50,53,56,57,60]);
    }


}
