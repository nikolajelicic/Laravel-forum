<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use \Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title' => $title = $this->faker->sentence,
            'content' => $this->faker->text,
            'slug' => Str::slug($title),
            'created_at' => $this->faker->dateTime,
            'updated_at' => now(),
            'user_id' => rand(1, 3),
            'category_id' => rand(1, 7)
        ];
    }
}
