<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','title','slug','description','thumbnail','content','view','is_published','especially','language'];


    public function user(){
        return $this->belongsTo(User::class)->first();
    }

    public function tags(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Tag::class);
    }

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class,'category_blogs');
    }
}
