<?php

namespace App\Traits;

trait VideoTrait
{
    public function save_video($video_request,$path){
        $name = time() . rand(10,1000) . '.' . $video_request->getClientOriginalExtension();
        $video_request->move($path,$name);
        return $name;
    }
    public function delete_video($videoName){
        if(file_exists($videoName))
            unlink($videoName);
    }
    public function is_video($video_request){
        $extension = $video_request->getClientOriginalExtension();
        return match ($extension) {
            'flv', 'FLV', 'mp4', 'MP4', 'm3u8', 'M3U8', 'ts', 'TS', '3gp', '3GP', 'mov', 'MOV', 'avi', 'AVI', 'wmv', 'WMV' => true,
            default => false,
        };
    }
}
