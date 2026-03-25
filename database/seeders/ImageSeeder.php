<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create storage directories if they don't exist
        $directories = [
            'storage/users',
            'storage/post-media',
            'storage/stories',
            'storage/reels',
        ];

        foreach ($directories as $dir) {
            if (!File::isDirectory($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
        }

        // Generate placeholder image files (minimal valid JPEG)
        $this->generateUserAvatars();
        $this->generatePostMediaImages();
        $this->generateStoryImages();
        $this->generateVideoPlaceholders();

        $this->command->info('All image and placeholder files created successfully!');
    }

    /**
     * Generate user avatar images (20 minimal valid JPEGs)
     */
    private function generateUserAvatars()
    {
        for ($i = 1; $i <= 20; $i++) {
            $this->createMinimalJpeg('storage/users/avatar-' . $i . '.jpg');
        }
        $this->command->line('✓ Created 20 user avatar images');
    }

    /**
     * Generate post media images (30 minimal valid JPEGs)
     */
    private function generatePostMediaImages()
    {
        for ($i = 1; $i <= 30; $i++) {
            $this->createMinimalJpeg('storage/post-media/image-' . $i . '.jpg');
        }
        $this->command->line('✓ Created 30 post media images');
    }

    /**
     * Generate story images (20 minimal valid JPEGs)
     */
    private function generateStoryImages()
    {
        for ($i = 1; $i <= 20; $i++) {
            $this->createMinimalJpeg('storage/stories/story-' . $i . '.jpg');
        }
        $this->command->line('✓ Created 20 story images');
    }

    /**
     * Generate placeholder video files
     */
    private function generateVideoPlaceholders()
    {
        // Create placeholder files for reels (15)
        for ($i = 1; $i <= 15; $i++) {
            File::put('storage/reels/video-' . $i . '.mp4', 'VIDEO_PLACEHOLDER_' . $i);
        }

        // Create placeholder files for post media videos (30)
        for ($i = 1; $i <= 30; $i++) {
            File::put('storage/post-media/video-' . $i . '.mp4', 'VIDEO_PLACEHOLDER_' . $i);
        }

        $this->command->line('✓ Created 45 placeholder video files');
    }

    /**
     * Create a minimal valid JPEG file
     */
    private function createMinimalJpeg($path)
    {
        // Minimal valid JPEG in binary format
        $jpeg = base64_decode(
            '/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAgGBgcGBQgHBwcJCQgKDBQNDAsLDBkSEw8UHRofHh0aHBwgJC4nICIsIxwcKDcpLDAxNDQ0Hyc5PTgyPC4zNDL/2wBDAQkJCQwLDBgNDRgyIRwhMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjL/wAARCAABAAEDASIAAhEBAxEB/8QAFQABAQAAAAAAAAAAAAAAAAAAAAv/xAAUEAEAAAAAAAAAAAAAAAAAAAAA/8VAFQEBAQAAAAAAAAAAAAAAAAAAAAX/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwCwAA8A/9k='
        );
        File::put($path, $jpeg);
    }
}
