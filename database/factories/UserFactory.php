<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $firstName = fake()->firstName();
        $lastName = fake()->lastName();
        $name = $firstName . ' ' . $lastName;
        $nickName = strtolower($firstName) . strtolower($lastName) . rand(100, 999);
        
        return [
            'name' => $name,
            'nick_name' => $nickName,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password123'),
            'bio' => fake()->sentence(6),
            'date_of_birth' => fake()->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d'),
            'phone' => fake()->unique()->numerify('+1##########'),
            'image' => 'avatar-' . rand(1, 20) . '.jpg',
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
