<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteOption extends Model
{
    protected $fillable=['name','address','geocode','email','telephone','meta_title','meta_description','meta_keyword'
    ,'zone','icon','logo' ,'mail_parameter','mail_username','mail_password','mail_mailer','mail_host','mail_port','mail_encription',
        'header_code','footer_code','custome_css','custome_js',
        'samandehi','enamad','saderat_terminal','meli_terminal','saderat_status','meli_status',
        'meli_merchent','meli_key','zarrinpall_merchent','zarrinpall_status',
        'sms_password','sms_usename','sms_panel','offline_pay','city','home','ads_link','ads_img','Signature',
        'register_sms','register_email','order_sms','order_email','order_complate_email','order_complate_sms'
        ,'register_sms_admin','register_email_admin','order_sms_admin','order_email_admin','comment_sms','comment_email'
        ,'question_sms','question_email','comment_product_sms','comment_product_email','contact_sms','contact_email'
        ,'comment_answer_sms','comment_answer_email','question_answer_sms','question_answer_email','ads_status','license'

    ];
    use HasFactory;
}
