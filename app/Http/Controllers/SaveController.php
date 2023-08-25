<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaveController extends Controller
{
    public function save(Request $request)
    {
        $audio = $request->audio;

        $imagebase = $request->picture;

        $image_name = 'canvas_' . time() . rand(11, 99);
        $imageget = explode('canvas_', $image_name);


        $folderPath = public_path("image/");
        $image_parts = explode(";base64,", $imagebase);
        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . $image_name . '.' . $image_type;
        $fileData = file_put_contents($file, $image_base64);

        $video = 'test1_' . rand(1111, 9999) . '.mp4';
        
        $audios = escapeshellarg($audio);
// dd($audios,$file);
$convert = "ffmpeg -r 1 -loop 1 -i $file -i $audios -acodec copy -r 1 -shortest -vf scale=1280:720 " . public_path("video/$video");
        exec($convert);
        exec($convert, $output, $return_var);
        error_log("Command to execute: " . $convert);
        error_log("FFmpeg Output: " . implode("\n", $output));
        error_log("Return Value: " . $return_var);
        if (file_exists(public_path("video/" . $video))) {
            return response()->json('Success');
        } else {
            return response()->json('Video creation failed', 500);
        }
    }
}
