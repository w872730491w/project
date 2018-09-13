<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Topic;


use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\Dimension;

class UploadController extends Controller
{
    public function uploads(Request $request, $type)
    {
        if($request->hasFile('img')){
            $files = $request->file('img');
            $pathArray = [];
            $uploadPath = '/uploads/'.$type.'/';
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();//得到图片名；
                $ext = $file->getClientOriginalExtension();//得到图片后缀；
                $fileName = md5(uniqid($name)).'.'.$ext;
                $file->move('.'.$uploadPath, $fileName);
                $pathArray[] = $uploadPath.$fileName;
            }
            return response()->json($pathArray);
        }
    }

    public function uploadAvatar(Request $request)
    {
    	$path = $this->moveImg($request, 'avatar');
    	if($path){
    		Auth::user()->update([
        		'avatar' => $path
	       	]);
	       	return response()->json($path);
    	}
    }

    public function uploadCover(Request $request)
    {
    	$path = $this->moveImg($request, 'cover');
    	if($path){
    		Auth::user()->profile->update([
        		'cover' => $path
	       	]);
	       	return response()->json($path);
    	}
    }

    public function uploadVideo(Request $request, $type)
    {
        if($request->hasFile('video')){

            $video = $request->file('video');
            $name = $video->getClientOriginalName();//得到图片名；
            $ext = $video->getClientOriginalExtension();//得到图片后缀；
            $fileName = md5(uniqid($name));
            $fileName = $fileName.'.'.$ext;//生成新的的文件名
            $video->move('./uploads/'.$type.'/', $fileName);
            $path = '/uploads/'.$type.'/'.$fileName;
            return $path;

        } else {

            return false;

        }
    }

    public function getVideoCover(Request $request, $type)
    {
        $path = '.'.$request->get('path');

        $ffmpeg = FFMpeg::create(array(
            'ffmpeg.binaries'  => 'C:\xampp\php\ffmpeg\bin\ffmpeg.exe',
            'ffprobe.binaries' => 'C:\xampp\php\ffmpeg\bin\ffprobe.exe',
            'timeout'          => 0, // The timeout for the underlying process
            'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
        ));

        $video = $ffmpeg->open($path);
        $videoCover = './uploads/'.$type.'/'.md5(uniqid(time().rand(1,999))).'png';
        $video->frame(TimeCode::fromSeconds(1))->save($videoCover);
        return $videoCover;
    }

    function moveImg(Request $request, $dir)
    {
    	if($request->hasFile('img')){

    		$img = $request->file('img');
	        $name = $img->getClientOriginalName();//得到图片名；
	        $ext = $img->getClientOriginalExtension();//得到图片后缀；
	        $fileName = md5(uniqid($name));
	        $fileName = $fileName.'.'.$ext;//生成新的的文件名
	        $img->move('./uploads/'.$dir.'/', $fileName);
	        $path = '/uploads/'.$dir.'/'.$fileName;
	        return $path;

	    } else {

    		return false;

    	}
    }

    public function uploadTopicPic(Request $request)
    {
        $path = $this->moveImg($request, 'topic');
        if($path){
            Topic::find($request->get('id'))->update([
                'topic_pic' => $path
            ]);
            return response()->json($path);
        }
    }
}
