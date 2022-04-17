<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable =['user_name','user_email','user_phone','user_password','user_status','created_at','updated_at'
];
    protected $primaryKey= 'user_id';
    protected $table = 'tbl_user';
}
