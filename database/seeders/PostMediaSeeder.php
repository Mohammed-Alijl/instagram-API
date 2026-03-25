<?php

namespace Database\Seeders;

use App\Models\PostMedia;
use Illuminate\Database\Seeder;

class PostMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 1-3 media items per post (total ~50 posts)
        PostMedia::factory(120)->create();
    }
}
