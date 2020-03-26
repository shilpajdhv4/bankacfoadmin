<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class Quotation extends Model
{
    protected $primaryKey = "id";
    public $table = "tbl_quotation";
    public $timestamps = true;
    protected $fillable = [
        'service_id', 'user_id', 'details_of_company', 'details_of_services', 'is_active', 'status',
        'quotation_replay'
    ];
}
