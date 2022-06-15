<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class banner extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','slug','description','thumbnail','link','order','language_id','created_at'];

    public function language()
    {
      return $this->belongsTo(LanguageSwitch::class);
    }
}
