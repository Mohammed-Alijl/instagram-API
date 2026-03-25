<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Generate images first
        $this->call([
            ImageSeeder::class,
        ]);

        // Create base entities
        $this->call([
            UserSeeder::class,
            PostSeeder::class,
            StorySeeder::class,
            ReelsSeeder::class,
        ]);

        // Create post media
        $this->call([
            PostMediaSeeder::class,
        ]);

        // Create comments and replies
        $this->call([
            CommentSeeder::class,
            ReplySeeder::class,
        ]);

        // Create relationships
        $this->call([
            UserFollowersSeeder::class,
            LikesSeeder::class,
            CommentLikeSeeder::class,
            ReplyLikeSeeder::class,
            PostSaveSeeder::class,
            ViewSeeder::class,
        ]);

        $this->command->info('Database seeding completed successfully! 🎉');
    }
}
