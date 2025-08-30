<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'bio' => fake()->paragraph(3),
            'profile_image' => null,
            'website' => fake()->url(),
            'social_twitter' => 'https://twitter.com/' . fake()->userName(),
            'social_linkedin' => 'https://linkedin.com/in/' . fake()->userName(),
            'social_instagram' => 'https://instagram.com/' . fake()->userName(),
            'is_active' => fake()->boolean(80), // %80 ihtimalle aktif
        ];
    }
}
