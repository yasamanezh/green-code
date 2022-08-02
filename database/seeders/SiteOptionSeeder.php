<?php

namespace Database\Seeders;

use App\Models\SiteOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Siteoption::create( [
            'home'=>'default',
            'name'=>'فروشگاه اینترنتی',
            'zone'=>'1',
            'city'=>'1',
            'address'=>'فارس شیراز',
            'ads_link'=>NULL,
            'email'=>'email@yahoo.com',
            'telephone'=>'09384054988',
            'ads_img'=>'photos/option/digikaa.jpg',
            'meta_title'=>'فروشگاه اینترنتی',
            'meta_description'=>'فروشگاه اینترنتی',
            'meta_keyword'=>'فروشگاه اینترنتی,فروشگاه آنلاین',
            'logo'=>'photos/option/logo.png',
            'icon'=>NULL,
            'mail_parameter'=>NULL,
            'mail_username'=>NULL,
            'mail_password'=>NULL,
            'samandehi'=>NULL,
            'enamad'=>NULL,
            'saderat_terminal'=>NULL,
            'saderat_status'=>NULL,
            'offline_pay'=>NULL,
            'zarrinpall_status'=>'1',
            'zarrinpall_merchent'=>'111111111111111111111111111111111111',
            'meli_status'=>NULL,
            'meli_terminal'=>NULL,
            'meli_merchent'=>NULL,
            'meli_key'=>NULL,
            'sms_panel'=>NULL,
            'sms_usename'=>NULL,
            'sms_password'=>NULL,
            'header_code'=>NULL,
            'footer_code'=>NULL,
            'custome_css'=>NULL,
            'custome_js'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>'2022-06-05 13:53:15',
            'Signature'=>NULL,
        ] );


    }
}
