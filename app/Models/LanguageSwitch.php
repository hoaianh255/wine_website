<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageSwitch extends Model
{
    use HasFactory;
    protected $fillable =['name','slug'];

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
      return $this->hasMany(Product::class);
    }

}
