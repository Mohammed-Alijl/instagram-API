<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Story>
 */
class StoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $mediaIndex = rand(1, 20);
        
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'media' => '/story-' . $mediaIndex . '.jpg',
        ];
    }
}
