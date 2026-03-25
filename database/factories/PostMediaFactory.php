<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostMedia>
 */
class PostMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $mediaIndex = rand(1, 30);
        $mediaType = rand(1, 100) > 20 ? 'video' : 'image'; // 80% images, 20% videos
        
        if ($mediaType === 'video') {
            $media = 'video-' . $mediaIndex . '.mp4';
        } else {
            $media = 'image-' . $mediaIndex . '.jpg';
        }
        
        return [
            'post_id' => Post::inRandomOrder()->first()?->id ?? Post::factory(),
            'media' => $media,
        ];
    }
}
