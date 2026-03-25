<?php

namespace Database\Seeders;

use App\Models\Reels;
use Illuminate\Database\Seeder;

class ReelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1-2 reels per user (15 users)
        Reels::factory(20)->create();
    }
}
