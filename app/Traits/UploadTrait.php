<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

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

        //Resize and Save Image
        $path = $image->storeAs($folder, $imageName, 'uploads');
        // Full path to the saved image
        $fullPath = $path.'/'.$imageName;

        Image::make($fullPath)->fit($width,$height, function ($constraint) {
            $constraint->upsize();
        })->save($fullPath);

        return $imageName;
        }catch(\Exception $e){
          throw new Exception($e->getMessage());
        }

    }
}


?>
