<?php

namespace Database\Seeders;

use App\Models\Story;
use App\Models\User;
use Illuminate\Database\Seeder;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stories = Story::all();
        $users = User::all();
        $inserts = [];

        foreach ($stories as $story) {
            // Each story is viewed by 3-20 users (excluding the story creator)
            $viewCount = rand(3, 20);
            $othersUsers = $users->where('id', '!=', $story->user_id);
            $viewersCount = min($viewCount, $othersUsers->count());
            
            if ($viewersCount > 0) {
                $viewers = $othersUsers->random($viewersCount);
                
                foreach ($viewers as $user) {
                    $inserts[] = [
                        'story_id' => $story->id,
                        'user_id' => $user->id,
                    ];
                }
            }
        }

        // Batch insert in chunks
        foreach (array_chunk($inserts, 500) as $chunk) {
            \DB::table('views')->insertOrIgnore($chunk);
        }

        $this->command->info('Story views created successfully!');
    }
}
