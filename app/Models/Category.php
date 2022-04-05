<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product as ModelsProduct;
class Category extends Model
{
    public $timestamps=false;
    protected $fillable =['category_name','category_decs','category_status','created_at','updated_at'
];
    protected $primaryKey= 'category_id';
    protected $table = 'tbl_category';
    public function product()
    {
        # code...
        return $this->hasMany(Product::class,'category_id');
    }
    
}