<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::create( [
            'id'=>1,
            'name'=>'دمو',
            'role'=>'hamkar',
            'email'=>'admin@gmail.com',
            'phone'=>'09384054988',
            'password'=>'$2y$10$ZCm3M34KoJhGCZyB3K2Dp.Rcmx.mG/jOQS5Qso8vSzj9HsfTG/uX2',
            'created_at'=>'2022-06-05 14:26:01',
            'updated_at'=>'2022-06-05 14:26:01'
        ] );
        User::create( [
            'id'=>2,
            'name'=>'ادمین سایت',
            'role'=>'admin',
            'email'=>'admin@admin.com',
            'phone'=>'09174255437',
            'password'=>'$2y$10$ZCm3M34KoJhGCZyB3K2Dp.Rcmx.mG/jOQS5Qso8vSzj9HsfTG/uX2',
            'created_at'=>'2022-06-05 14:26:01',
            'updated_at'=>'2022-06-05 14:26:01'
        ] );
        $user->roles()->sync([1]);
    }
}
