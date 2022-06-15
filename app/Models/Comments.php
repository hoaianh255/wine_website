<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $fillable =['commenter_id','commenter_type','guest_name','guest_email','commentable_type','commentable_id','comment','approved','child_id'];
}
