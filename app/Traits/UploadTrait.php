<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

Trait UploadTrait{

    private function uploadImage($image,$folder,$width=300,$height=300)
    {

        try{

            $path=storage_path('app/uploads/',$folder);


        $imageName=uniqid().'.'.$image->getClientOriginalExtension();



        //Check Path is exist or not
        if(!File::isDirectory($path))
        {
          File::makeDirectory($path, 0777, true, true);
        }




        // Full path to the saved image

        $fullPath = $path.$imageName;
      //  dd($fullPath);

        Image::make($image)->fit($width,$height, function ($constraint) {
            $constraint->upsize();
        })->save($fullPath);


        return $imageName;
        }catch(\Exception $e){
          throw new Exception($e->getMessage());
        }

    }


    //Delete Image
    private function deleteImage($image)
    {
        $path="uploads/products/".$image;
        if(Storage::exists($path))
        {
            Storage::delete($path);
        }
    }

    //Show Image
    public function showImage($image)
    {
        $path="uploads/products/".$image;
        if(Storage::exists($path))
        {
            $mimeType=Storage::mimeType($path);
            $headers=[
                'Content-Type'=>$mimeType,
            ];

            return response()->file(storage_path("app/".$path),$headers);
        }
    }
}


?>
