<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reels>
 */
class ReelsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $videoIndex = rand(1, 15);
        
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'reels' => 'video-' . $videoIndex . '.mp4',
        ];
    }
}
