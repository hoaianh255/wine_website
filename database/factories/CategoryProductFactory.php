<?php

namespace Database\Factories;

use App\Models\CategoryProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoryProduct::class;

  /**
   * Define the model's default state.
   *
   * @return array
   * @throws \Exception
   */
    public function definition() : array
    {
        return [
            'category_id'=>random_int(1,8),
            'product_id'=>random_int(1,100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
