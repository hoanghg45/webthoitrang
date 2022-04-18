<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory; 
    public $timestamps = false;
    protected $fillable = [
        'customer_id','address', 'order_status','order_total',
        'created_at'
    ];
    protected $primaryKey = 'order_id';
    protected $table = 'orders';

}
