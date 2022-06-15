<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable =['user_id','code','value','expiry'];

    public function users(){
        return $this->belongsTo(User::class);
    }

}
