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
            'avatar'=>NULL,
            'email_verified_at'=>NULL,
            'phone_verified_at'=>NULL,
            'password'=>'$2y$10$ZCm3M34KoJhGCZyB3K2Dp.Rcmx.mG/jOQS5Qso8vSzj9HsfTG/uX2',
            'two_factor_secret'=>NULL,
            'two_factor_recovery_codes'=>NULL,
            'two_factor_confirmed_at'=>NULL,
            'remember_token'=>NULL,
            'current_team_id'=>NULL,
            'profile_photo_path'=>NULL,
            'created_at'=>'2022-06-05 14:26:01',
            'updated_at'=>'2022-06-05 14:26:01'
        ] );
        User::create( [
            'id'=>2,
            'name'=>'ادمین سایت',
            'role'=>'admin',
            'email'=>'admin@admin.com',
            'phone'=>'09174255437',
            'avatar'=>NULL,
            'email_verified_at'=>NULL,
            'phone_verified_at'=>NULL,
            'password'=>'$2y$10$ZCm3M34KoJhGCZyB3K2Dp.Rcmx.mG/jOQS5Qso8vSzj9HsfTG/uX2',
            'two_factor_secret'=>NULL,
            'two_factor_recovery_codes'=>NULL,
            'two_factor_confirmed_at'=>NULL,
            'remember_token'=>NULL,
            'current_team_id'=>NULL,
            'profile_photo_path'=>NULL,
            'created_at'=>'2022-06-05 14:26:01',
            'updated_at'=>'2022-06-05 14:26:01'
        ] );
        $user->roles()->sync([1]);
    }
}
