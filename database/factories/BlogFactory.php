<?php

namespace Database\Factories;

use App\Models\Blog;
Use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userid = rand(1,20);
        $title = $this->faker->sentence();
        $enum = ['0','1'];
        return [
            'user_id'=> $userid,
            'title' => $title,
            'slug' => str_slug($title),
            'description'=>$this->faker->sentence(),
            'thumbnail'=>$this->faker->imageUrl(),
            'content'=>$this->faker->paragraph($maxNbChars = 150),
            'view'=> rand(0,1000),
            'is_published'=> $enum[rand(0,1)],
            'especially'=> $enum[rand(0,1)],
            'language_id'=>rand(1,2),
             'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
