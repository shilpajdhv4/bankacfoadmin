<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionField extends Model
{
    protected $primaryKey = "id";
    public $table = "tbl_subscription_fields";
    public $timestamps=true;
    protected $fillable = [
        'subscription_id','field_title','field_type','is_recurring','recurring_frequency','is_mandatory','field_extras','recurring_reminder_day'
        ,'created_at','modified_at','created_by','modified_by','is_office_only'
    ];
}
