<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class LikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();
        $users = User::all();
        $inserts = [];

        foreach ($posts as $post) {
            // Each post gets 5-30 likes from different users
            $likeCount = rand(5, 30);
            $usersWhoLike = $users->random(min($likeCount, $users->count()));

            foreach ($usersWhoLike as $user) {
                $inserts[] = [
                    'post_id' => $post->id,
                    'user_id' => $user->id,
                ];
            }
        }

        // Batch insert in chunks
        foreach (array_chunk($inserts, 1000) as $chunk) {
            \DB::table('likes')->insertOrIgnore($chunk);
        }

        $this->command->info('Post likes created successfully!');
    }
}
