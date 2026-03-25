<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        $captions = [
            'Beautiful sunset at the beach 🌅',
            'Coffee and thoughts ☕',
            'Amazing day with my friends 👯',
            'Life is beautiful when you look at it the right way ✨',
            'Taking a moment to appreciate the little things 🌸',
            'Blessed and grateful 🙏',
            'Adventure awaits 🗺️',
            'Golden hour magic ✨',
            'Just vibes 💫',
            'Creating memories that last a lifetime 📸',
            'Every moment counts 💭',
            'Smile more, worry less 😊',
            'Living my best life 🌟',
            'Capture the moment 📷',
            'Peace, love, and good vibes ✌️',
        ];
        
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'caption' => fake()->randomElement($captions),
        ];
    }
}
