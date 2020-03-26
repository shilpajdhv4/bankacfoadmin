<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vertical extends Model
{
    protected $primaryKey = "id";
    public $table = "tbl_vertical";
    public $timestamps=true;
    protected $fillable = [
        'vertical_name','short_desc','long_desc','upload_img','is_active'
    ];
}
