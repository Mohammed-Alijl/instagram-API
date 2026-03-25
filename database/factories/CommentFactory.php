<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $comments = [
            'Amazing! Love this 😍',
            'This is so cool! 🔥',
            'Absolutely beautiful! 💎',
            'I love this so much!',
            'This made my day! 😊',
            'Incredible work! 👏',
            'Can\'t stop looking at this',
            'So inspiring! ✨',
            'You rock! 🎸',
            'This is fire! 🌟',
            'Love the vibes!',
            'Perfection! 💯',
            'Simply amazing!',
            'Best thing I\'ve seen today',
            'Keep it up!',
        ];
        
        return [
            'post_id' => Post::inRandomOrder()->first()?->id ?? Post::factory(),
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'comment' => fake()->randomElement($comments),
        ];
    }
}
