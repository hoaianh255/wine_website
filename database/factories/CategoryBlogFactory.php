<?php

namespace Database\Factories;

use App\Models\CategoryBlog;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryBlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoryBlog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id'=>rand(9,14),
            'blog_id'=>rand(1,100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
