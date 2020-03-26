<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $primaryKey = "id";
    public $table = "tbl_service";
    public $timestamps=true;
    protected $fillable = [
        'vertical_id','category_id','service_name','short_desc','long_desc','upload_img','type_of_service','is_active'
    ];
}
