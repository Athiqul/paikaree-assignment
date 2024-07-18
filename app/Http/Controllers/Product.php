<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest as UpdateProduct;
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
    public function index(Request $request)
    {
        // Determine the limit for pagination (default: 10)
        $limit = $request->query('limit', 10);

        // Determine the order for sorting (default: 'asc')
        $order = $request->query('price', 'asc');

        // Retrieve paginated products with optional search query
        $products = ModelsProduct::orderBy('price', $order)
                           ->when($request->filled('search')!=='', function ($query) use ($request) {
                               $searchTerm = $request->query('search');
                               return $query->where('name', 'like', '%' . $searchTerm . '%');
                               // Add more fields to search as needed
                           })
                           ->paginate($limit);

        // Return paginated results as JSON
        return response()->json($products, 200);
    }

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
                "discount"=>$request->discount*100,
                "price"=>$request->price*100,
                "thumbnail"=>$thumbName,
                "status"=>$request->status,
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

            return response()->json([
               'success' => true,
               'message' => 'Product created successfully',
            ],200);

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
     * Display the specified resource. Both edit and Show
     */
    public function show(string $id)
    {
         $product=ModelsProduct::with('images')->find($id);
         if($product==null)
         {
             return response()->json([
                'success' => false,
                'message' => 'Product not found',
             ],200);
         }
         return response()->json([
            'success' => true,
             'product' => $product,
         ],200);
    }

    /**
     * Update the specified resource in storage.
     */



    public function updateItem(UpdateProduct $request,string $id)
    {
        try {


            //dd($request->all());

            //Check Product Exist
            $product=ModelsProduct::with('images')->find($id);
            if($product==null)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found',
                ],200);
            }
            //Handling Product Thumbnail
            $thumbName=null;
            if($request->hasFile('thumbnail'))
            {
                   //Deleting previous image from folder
                  $this->deleteImage($product->thumbnail);
                  //Store new Image
                  $thumbnailFile=$request->file('thumbnail');
                  //Store image file
                  $thumbName=$this->uploadImage($thumbnailFile,'products',300,300);
            }


            //Save Product

            //Check product name is exist for other products or not
            $check=ModelsProduct::where('name',$request->name)->where('id','!=',$product->id)->first();
            if($check)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Already Have that same name product in the system !',
                 ],200);
            }
            $product->name=$request->name;
            $product->price=$request->price*100;
            $product->discount=$request->discount*100;
            $product->thumbnail=$thumbName??$product->thumbnail;
            $product->status=$request->status;

            if($product->isClean())
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Nothing to update',
                 ],200);
            }

            $product->save();

             // Handle Multiple Upload Images
             if ($request->hasFile('product_images')) {

                //Removing Current Images
                if($request->remove_image=="1")
                {
                      foreach($product->images as $image){

                        $this->deleteImage($image);

                      }
                }

                foreach ($request->file('product_images') as $image) {

                     $imageName=$this->uploadImage($image,'products',300,300);
                     ProductImage::create([
                        "product_id"=>$product->id,
                        "image"=>$imageName,
                     ]);
                }

            }

            DB::commit();

            return response()->json([
               'success' => true,
               'message' => 'Product created successfully',
            ],200);

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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $product=ModelsProduct::find($id);
            if(!$product)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Product does not found!',
                    'errors' => '',
                ],200);
            }

            //Delete Product Images
$productImages=ProductImage::where('product_id',$id)->delete();
            $product->delete();
            return response()->json([
                'success' => true,
                'message' => 'Successfully Product Remove the System',
                'errors' => '',
            ],200);
        }catch(\Exception $e)
        {
            return response()->json([
                'success' => false,
                'message' => 'Exception occurs',
                'errors' => $e->getMessage(),
            ],200);
        }
    }


    //Make Publish & unpublish
    public function status($id)
    {
        try{
            $product=ModelsProduct::find($id);
            if(!$product)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Product does not found',
                    'errors' => '',
                ],200);
            }

            $product->status=($product->status=="1")?'0':'1';
            $product->save();
            $msg=($product->status=="1")?'Published':'Unpublished';
            return response()->json([
                'success' => true,
                'message' => "Successfully Product $msg ",
                'errors' => '',
            ],200);
        }catch(\Exception)
        {
            return response()->json([
                'success' => false,
                'message' => 'Exception occurs',
                'errors' => $e->getMessage(),
            ],200);
        }
    }
}
