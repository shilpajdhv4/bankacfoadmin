<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = "id";
    public $table = "tbl_category";
    public $timestamps=true;
    protected $fillable = [
        'vertical_id','category_name','short_desc','long_desc','upload_img','is_active'
    ];
}
