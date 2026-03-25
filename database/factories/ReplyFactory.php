<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reply>
 */
class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $replies = [
            'Thanks so much! 🙏',
            'Right?? 😄',
            'I totally agree!',
            'Couldn\'t have said it better!',
            'Absolutely! 💯',
            'So true!',
            'Haha yes!',
            'Facts! 📝',
            'And how!',
            'For real though',
            'This comment wins',
            'Perfectly said',
            'Amen to that!',
            'No cap',
            'Straight facts',
        ];
        
        return [
            'comment_id' => Comment::inRandomOrder()->first()?->id ?? Comment::factory(),
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'reply' => fake()->randomElement($replies),
        ];
    }
}
