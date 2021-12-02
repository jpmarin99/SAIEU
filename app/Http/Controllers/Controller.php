<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
//Funcion para subir archivos desde la APP
    public function saveImage($image, $path = 'public')
    {
        if(!$image)
        {
            return null;
        }

        $filename = time().'.png';
        // save image
        Storage::disk($path)->put($filename, base64_decode($image));

        //return the path
        // Url is the base url exp: localhost:8000
        return URL::to('/').'/storage/'.$path.'/'.$filename;
    }



//Funcion para subir archivos desde la WEB
    public function saveImageWeb($image, $path = 'public')
    {
        if(!$image)
        {
            return null;
        }

        $filename = time().'.'.$image->getClientOriginalExtension();
        // save image
        Storage::disk($path)->put($filename, File::get($image));
        $image->image = $filename;
        //return the path
        // Url is the base url exp: localhost:8000
        return URL::to('/').'/storage/'.$path.'/'.$filename;
    }
}
