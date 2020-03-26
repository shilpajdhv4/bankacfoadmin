<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceSubscribed extends Model
{
    protected $primaryKey = "id";
    public $table = "tbl_services_subscribed";
    public $timestamps = true;
    protected $fillable = [
        'service_date', 'user_id', 'subscription_id', 'status', 'payment_id', 'payment_status', 'payment_request_id', 'is_active'
    ];
}
