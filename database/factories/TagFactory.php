<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $random = rand(1,20);
        $enum = [$random,null];
        $primary = ['0','1'];
        $product_id = $enum[rand(0,1)];
        if($product_id == null){
          $blog_id = rand(1,20);
        }else{
          $blog_id = null;
        }
        $name = $this->RandomString();
        return [
            'product_id'=>$product_id,
            'blog_id'=>$blog_id,
            'name'=>$name,
            'slug'=>str_slug($name),
            'primary'=>$primary[rand(0,1)],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    public function RandomString()
    {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < 6; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }
}
