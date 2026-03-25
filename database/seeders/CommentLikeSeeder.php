<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comments = Comment::all();
        $users = User::all();
        $inserts = [];

        foreach ($comments as $comment) {
            // Each comment gets 0-10 likes
            $likeCount = rand(0, 10);
            if ($likeCount > 0) {
                $usersWhoLike = $users->random(min($likeCount, $users->count()));
                
                foreach ($usersWhoLike as $user) {
                    $inserts[] = [
                        'comment_id' => $comment->id,
                        'user_id' => $user->id,
                    ];
                }
            }
        }

        // Batch insert in chunks
        foreach (array_chunk($inserts, 500) as $chunk) {
            \DB::table('comment_likes')->insertOrIgnore($chunk);
        }

        $this->command->info('Comment likes created successfully!');
    }
}
