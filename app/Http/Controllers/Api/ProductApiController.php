<?php

namespace App\Http\Controllers\Api;

use DateTime;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Resources\ProductResource;

class ProductApiController extends Controller
{
    public function productApiList(Request $request)
    {
        $limit = $request->input('limit', 1); 
        $page = $request->input('page', 1); 

        $products = Product::paginate($limit, ['*'], 'page', $page);

        return [
            'products' => ProductResource::collection($products),
            'pagination' => [
                'current_page' => $products->currentPage(),
                'total_pages' => $products->lastPage(),
                'total_products' => $products->total(),
            ],
        ];
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return new ProductResource($product);
    }


    public function productApiAdd(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string',
            'export_price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'description' => 'required|string',
        ]);

        $imageDirectory = public_path('Web/images');
        if (!File::isDirectory($imageDirectory)) {
            File::makeDirectory($imageDirectory, 0755, true);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();

            try {
                $image->move($imageDirectory, $imageName);
            } catch (\Exception $e) {
                Log::error('Failed to move the image: ' . $e->getMessage());

                return response()->json(['error' => 'Failed to move the image.'], 500);
            }
        } else {
            return response()->json(['error' => 'No image provided.'], 400);
        }

        $product = new Product([
            'product_name' => $request->input('product_name'),
            'export_price' => $request->input('export_price'),
            'image' => $imageName,
            'description' => $request->input('description'),
            'created_at' => new DateTime(),
        ]);


        try {
            $product->save();
        } catch (\Exception $e) {
            Log::error('Failed to save the product: ' . $e->getMessage());

            return response()->json(['error' => 'Failed to save the product.'], 500);
        }

        $productArray = $product->toArray();
        return response()->json(['product' => $productArray]);
    }

    
    public function productApiEdit($id,Request $request)
    {
        $request->validate([
            'product_name' => 'required|string',
            'export_price' => 'required|numeric',
            'description' => 'required|string',
        ]);
    
        $product = Product::find($id);
    
        if (!$product) {
            return response()->json(['error' => 'Product not found.'], 404);
        }
    
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            ]);
    
            $oldImage = $product->image;
    

            $newImage = $request->file('image');
            $newImageName = Str::uuid() . '.' . $newImage->getClientOriginalExtension();
    
            try {
                $newImage->move(public_path('Web/images'), $newImageName);
            } catch (\Exception $e) {
                Log::error('Failed to move the new image: ' . $e->getMessage());
                return response()->json(['error' => 'Failed to move the new image.'], 500);
            }

            $product->image = $newImageName;
    

            if ($oldImage && file_exists(public_path('Web/images') . '/' . $oldImage)) {
                unlink(public_path('Web/images') . '/' . $oldImage);
            }
        }
    
        $product->update([
            'product_name' => $request->input('product_name'),
            'export_price' => $request->input('export_price'),
            'description' => $request->input('description'),
        ]);
    
        $productArray = $product->toArray();
        return response()->json(['product' => $productArray]);
    }
    

    public function productApiDelete($id)
    {
        try {

            $product = Product::find($id);

            // \Log::info("Deleting product ID: $id");

            $product->delete();

            return response()->json(['message' => 'Product deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete product'], 500);
        }
    }
}
