<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product as ModelsProduct;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Traits\UploadTrait;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
class Product extends Controller
{

    use UploadTrait;
    //Display product Page
    public function product():view
    {
        return view('product');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=ModelsProduct::get();
        return response()->json($products,200);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {

    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $validated = $request->validated();
            //Handling Product Thumbnail
            if($request->hasFile('thumbnail'))
            {
                  $thumbnailFile=$request->file('thumbnail');
                  //Store image file
                  $thumbName=$this->uploadImage($thumbnailFile,'products',300,300);
            }


            //Save Product
           DB::beginTransaction();
            $product=ModelsProduct::create([
                "name"=>$request->name,
                "discount"=>$request->discount,
                "price"=>$request->price,
                "thumbnail"=>$thumbName,
            ]);

             // Handle Multiple Upload Images
             if ($request->hasFile('product_images')) {

                foreach ($request->file('product_images') as $image) {
                     $imageName=$this->uploadImage($image,'products',300,300);
                     ProductImage::create([
                        "product_id"=>$product->id,
                        "image"=>$imageName,
                     ]);
                }

            }

            DB::commit();

        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Exception occurs',
                'errors' => $e->getMessage(),
            ],200);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
