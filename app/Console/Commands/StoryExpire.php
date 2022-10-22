<?php

namespace App\Console\Commands;

use App\Models\Story;
use App\Traits\ImageTrait;
use App\Traits\VideoTrait;
use Carbon\Carbon;
use Illuminate\Console\Command;

class StoryExpire extends Command
{
    use ImageTrait, VideoTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:story';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete story form database and delete all media about this story after 24 hours';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $stories = Story::get();
        foreach ($stories as $story){
            Carbon::parse($story->created_at)->addDay() < Carbon::now();
            $this->isImage($story->media) ? $this->delete_image('img/stories/' . $story->media) : $this->delete_video('video/stories/' . $story->media);
            $story->delete();
        }
    }
}
