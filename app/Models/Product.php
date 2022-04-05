<?php

namespace App\Models;

use App\Http\Controllers\CategoryProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps=false;
    protected $fillable =['category_id','product_name','product_desc','product_size','product_price','product_image','product_status','product_quantity','created_at','updated_at'
];
    protected $primaryKey= 'product_id';
    protected $table = 'tbl_product';

    public function product()
    {
        # code...
        return $this->belongsTo(CategoryProduct::class,'category_id');
    }
}
