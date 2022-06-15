<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

  /**
   * Define the model's default state.
   *
   * @return array
   * @throws \Exception
   */
    public function definition(): array
    {
        $userid = random_int(1,20);
        $name = $this->faker->sentence();
        $discount = random_int(0,100000);
        $nation = ['Việt Nam','America','Japan','China'];
        $view = random_int(0,1000);
        $bought = random_int(0,1000);
        $size = ['500ml','700ml'];
        $vintage = ['1990','2012','2014','1988'];
        $enum = ['0','1'];
        return [
            'user_id'=>$userid,
            'codeProduct'=>$this->RandomString(),
            'name'=>$name,
            'slug'=>str_slug($name),
            'thumbnail'=>$this->faker->imageUrl(),
            'price'=>random_int(100000,900000),
            'size'=>$size[random_int(0,1)],
            'vintage'=>$vintage[random_int(0,3)],
            'detail'=>$this->faker->paragraph($maxNbChars = 10),
            'discount'=>$discount,
            'nation'=> $nation[array_rand($nation,1)],
            'description'=>$this->faker->paragraph($maxNbChars = 50),
            'view'=> $view,
            'bought'=> $bought,
            'language_id'=> random_int(1,2),
            'is_published'=> '1',
            'especially'=> $enum[random_int(0,1)],
            'amount'=>random_int(0,300),
            'created_at' => now(),
            'updated_at' => now(),

        ];
    }
    public function RandomString(): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
          try {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
          } catch (\Exception $e) {
            echo "error while created random string";
          }
        }
        return $randomString;
    }
}
