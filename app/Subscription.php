<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $primaryKey = "id";
    public $table = "tbl_subscription";
    public $timestamps=true;
    protected $fillable = [
        'vertical_id','category_id','service_id','subscription_name','subscription_image','subscription_price','text_to_be_display','condition_package_wise'
        ,'is_recurring','duration','remindar_before_days','is_active'
    ];
}
