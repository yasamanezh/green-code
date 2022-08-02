<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'id'=>'1',
            'name'=>'edit_product',
            'label'=>'edit',
            'description'=>' محصول'
            ]);
        Permission::create( [
            'name'=>'delete_product',
            'label'=>'delete',
            'description'=>' محصول',
        ]);
        Permission::create( [
            'name'=>'show_product',
            'label'=>'show',
            'description'=>' محصول',
        ]);
        Permission::create( [
            'name'=>'show_category',
            'label'=>'show',
            'description'=>' دسته بندی ها',
        ]);
        Permission::create( [
            'name'=>'delete_category',
            'label'=>'delete',
            'description'=>' دسته بندی',
        ]);
        Permission::create( [
            'name'=>'show_attr',
            'label'=>'show',
            'description'=>' خصوصیات',
        ]);
        Permission::create( [
            'name'=>'show_brand',
            'label'=>'show',
            'description'=>' برندها',
        ]);
        Permission::create( [
            'name'=>'edit_brand',
            'label'=>'edit',
            'description'=>' برندها',
        ]);
        Permission::create( [
            'name'=>'delete_brand',
            'label'=>'delete',
            'description'=>' برندها',
        ]);

        Permission::create( [
            'name'=>'show_garranty',
            'label'=>'show',
            'description'=>' گارانتی',
        ]);
        Permission::create( [
            'name'=>'edit_garranty',
            'description'=>' گارانتی',
            'label'=>'edit',
        ]);
        Permission::create( [
            'name'=>'delete_garranty',
            'label'=>'delete',
            'description'=>' گارانتی',
        ]);
        Permission::create( [

            'name'=>'show_filter',
            'label'=>'show',
            'description'=>' فیلتر',
        ]);
        Permission::create( [
            'name'=>'delete_filter',
            'label'=>'delete',
            'description'=>' فیلتر',
        ]);
        Permission::create( [
            'name'=>'edit_filter',
            'label'=>'edit',
            'description'=>' فیلتر',
        ]);

        Permission::create( [
            'name'=>'show_blog',
            'label'=>'show',
            'description'=>' دسته بندی وبلاگ',
        ]);
        Permission::create( [
            'name'=>'edit_blog',
            'label'=>'edit',
            'description'=>' دسته بندی وبلاگ',
        ]);
        Permission::create( [
            'name'=>'delete_blog',
            'label'=>'delete',
            'description'=>' دسته بندی وبلاگ',
        ]);
        Permission::create( [
            'name'=>'show_post',
            'label'=>'show',
            'description'=>' مقالات',
        ]);
        Permission::create( [
            'name'=>'edit_post',
            'label'=>'edit',
            'description'=>' مقالات',
        ]);
        Permission::create( [
            'name'=>'delete_post',
            'label'=>'delete',
            'description'=>' مقالات',
        ]);
        Permission::create( [
            'name'=>'show_page',
            'label'=>'show',
            'description'=>' برگه ها',
        ]);
        Permission::create( [
            'name'=>'edit_page',
            'label'=>'edit',
            'description'=>' برگه ها',
        ]);


        Permission::create( [
            'name'=>'delete_page',
            'label'=>'delete',
            'description'=>' برگه ها',
        ]);

        Permission::create( [
            'name'=>'show_role',
            'label'=>'show',
            'description'=>' مقام ها',
        ]);
        Permission::create( [
            'name'=>'edit_role',
            'label'=>'edit',
            'description'=>' مقام ها',
        ]);
        Permission::create( [
            'name'=>'delete_role',
            'label'=>'delete',
            'description'=>' مقام ها',
        ]);



        Permission::create( [
            'name'=>'show_design',
            'label'=>'show',
            'description'=>' طراحی',
        ]);
        Permission::create( [
            'name'=>'edit_design',
            'label'=>'edit',
            'description'=>' طراحی',
        ]);
         Permission::create( [
            'name'=>'delete_design',
            'label'=>'delete',
            'description'=>' طراحی',
        ]);

        Permission::create( [
            'name'=>'show_discount',
            'label'=>'show',
            'description'=>' تخفیف ها',
        ] );
        Permission::create( [
            'name'=>'edit_discount',
            'label'=>'edit',
            'description'=>' تخفیف ها',
        ] );
         Permission::create( [
            'name'=>'delete_discount',
            'label'=>'delete',
            'description'=>' تخفیف ها',
        ] );

        Permission::create( [
            'name'=>'show_option',
            'label'=>'show',
            'description'=>' تنظیمات سایت',
        ] );
        Permission::create( [

            'name'=>'edit_option',
            'label'=>'edit',
            'description'=>' تنظیمات سایت',
       ]);
        Permission::create( [

            'name'=>'delete_option',
            'label'=>'delete',
            'description'=>' تنظیمات سایت',
       ]);

        Permission::create( [
            'name'=>'show_order',
            'label'=>'show',
            'description'=>' سفارشات',
        ]);
        Permission::create( [
            'name'=>'edit_order',
            'label'=>'edit',
            'description'=>' سفارش ها',
        ]);
        Permission::create( [
            'name'=>'delete_order',
            'label'=>'delete',
            'description'=>' سفارش ها',
        ]);

        Permission::create( [

            'name'=>'edit_category',
            'label'=>'edit',
            'description'=>'دسته بندی ها',
        ]);
        Permission::create( [
           'name'=>'show_comment',
            'label'=>'show',
            'description'=>'دیدگاه ها',
        ]);
        Permission::create( [
            'name'=>'edit_comment',
            'label'=>'edit',
            'description'=>'دیدگاه ها',
        ]);
         Permission::create( [
            'name'=>'delete_comment',
            'label'=>'delete',
            'description'=>'دیدگاه ها',
        ]);

        Permission::create( [
            'name'=>'show_dashboard',
            'label'=>'show',
            'description'=>'داشبورد',
        ]);
        Permission::create( [
            'name'=>'edit_attr',
            'label'=>'edit',
            'description'=>'خصوصیات',
        ]);

        Permission::create( [
            'name'=>'edit_newsletter',
            'label'=>'edit',
            'description'=>'خبرنامه',
        ]);
        Permission::create( [
            'name'=>'show_newsletter',
            'label'=>'show',
            'description'=>'خبرنامه',
        ]);
        Permission::create( [
            'name'=>'delete_newsletter',
            'label'=>'delete',
            'description'=>'خبرنامه',
        ]);

        Permission::create( [
            'name'=>'edit_AdminLogs',
            'label'=>'edit',
            'description'=>'رویدادها',
        ]);
        Permission::create( [
            'name'=>'show_AdminLogs',
            'label'=>'show',
            'description'=>'رویدادها ',
        ]);
         Permission::create( [
            'name'=>'delete_AdminLogs',
            'label'=>'delete',
            'description'=>'رویدادها ',
        ]);


        Permission::create( [

            'name'=>'edit_notification',
            'label'=>'edit',
            'description'=>'اعلانات',
        ] );
        Permission::create( [
            'name'=>'show_notification',
            'label'=>'show',
            'description'=>'اعلانات',
        ] );
         Permission::create( [
            'name'=>'delete_notification',
            'label'=>'delete',
            'description'=>'اعلانات',
        ] );

        Permission::create( [
            'name'=>'edit_tools',
            'label'=>'edit',
            'description'=>'ابزارها',
        ] );
        Permission::create( [

            'name'=>'show_tools',
            'label'=>'show',
            'description'=>'ابزارها',
        ] );
        Permission::create( [
            'name'=>'show_user',
            'label'=>'show',
            'description'=>' کاربر',
        ]);
        Permission::create( [

            'name'=>'edit_user',
            'label'=>'edit',
            'description'=>' کاربر',
        ]);
         Permission::create( [

            'name'=>'delete_user',
            'label'=>'delete',
            'description'=>' کاربر',
        ]);
        Permission::create( [
            'name'=>'show_shipping',
            'label'=>'show',
            'description'=>'روش های ارسال',
        ]);
        Permission::create( [
            'name'=>'edit_shipping',
            'label'=>'edit',
            'description'=>'روش های ارسال',
        ]);
       Permission::create( [
            'name'=>'delete_shipping',
            'label'=>'delete',
            'description'=>'روش های ارسال',
        ]);


    }
}
