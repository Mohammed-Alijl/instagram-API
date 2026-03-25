<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSaveSeeder extends Seeder
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
            // Each post is saved by 0-15 users
            $saveCount = rand(0, 15);
            if ($saveCount > 0) {
                $usersSave = $users->random(min($saveCount, $users->count()));
                
                foreach ($usersSave as $user) {
                    $inserts[] = [
                        'post_id' => $post->id,
                        'user_id' => $user->id,
                    ];
                }
            }
        }

        // Batch insert in chunks
        foreach (array_chunk($inserts, 500) as $chunk) {
            \DB::table('post_saves')->insertOrIgnore($chunk);
        }

        $this->command->info('Post saves created successfully!');
    }
}
