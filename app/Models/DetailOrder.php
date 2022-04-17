<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'order_details_id', 'order_id', 'product_id', 
        'product_name','product_price',
        'product_sale_quantity'
    ];
    protected $primaryKey = 'order_details_id';
    protected $table = 'detail_orders';

    public function product(){
        return $this->belongsTo(Product::class,'category_id');
    }
}
