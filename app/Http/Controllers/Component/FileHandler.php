<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;

class FileHandler extends Controller
{
    public function currentController()
    {
        $currentController = strtolower(str_replace('Controller','',class_basename(Route::current()->controller)));
        return $currentController;
    }


    public function fileUpload($file, $fieldName, $size = ['width' => null, 'height' => null])
    {

        // make validation
        if($fieldName){
            request()->validate([
                $fieldName => 'mimes:jpg,jpeg,bmp,png'
            ], [
                $fieldName.'.mimes' => 'Invalid file type to upload!'
            ]);
        }

        $setImageName = rand(). '-' . uniqid(). '.' .$file->getClientOriginalExtension();
        $success =  Image::make($file)->save(public_path('backend/uploads/images/'.$this->currentController().'/'.$setImageName),100);

        if ($success)
        {
            return $setImageName;
        }

    }


    public function fileDelete($fileName)
    {
        $path = 'backend/uploads/images/'.$this->currentController().'/'.$fileName;
        if (file_exists($path)){
            unlink($path);
        }
    }

}
