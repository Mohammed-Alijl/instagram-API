<?php

namespace Database\Seeders;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReplyLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $replies = Reply::all();
        $users = User::all();
        $inserts = [];

        foreach ($replies as $reply) {
            // Each reply gets 0-8 likes
            $likeCount = rand(0, 8);
            if ($likeCount > 0) {
                $usersWhoLike = $users->random(min($likeCount, $users->count()));
                
                foreach ($usersWhoLike as $user) {
                    $inserts[] = [
                        'reply_id' => $reply->id,
                        'user_id' => $user->id,
                    ];
                }
            }
        }

        // Batch insert in chunks
        foreach (array_chunk($inserts, 500) as $chunk) {
            \DB::table('reply_likes')->insertOrIgnore($chunk);
        }

        $this->command->info('Reply likes created successfully!');
    }
}
