<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserFollowersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $inserts = [];

        foreach ($users as $user) {
            // Each user follows 5-12 other random users
            $followCount = rand(5, 12);
            $usersToFollow = $users->where('id', '!=', $user->id)->random(min($followCount, $users->count() - 1));
            
            foreach ($usersToFollow as $followUser) {
                $inserts[] = [
                    'user_id' => $user->id,
                    'follower_id' => $followUser->id,
                ];
            }
        }

        // Batch insert in chunks
        foreach (array_chunk($inserts, 500) as $chunk) {
            \DB::table('user_followers')->insertOrIgnore($chunk);
        }

        $this->command->info('User followers relationships created successfully!');
    }
}
