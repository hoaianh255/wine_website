<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','user_name','total','discount_amount','ship_address','ship_email','ship_phone','status','payment_type','day_buy','day_ship','created_at'];
}
