<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductImage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'brand', 'product_images')->get();
        // dd($products);
        $brands = Brand::get();
        $categories = Category::get();

        return Inertia::render('Admin/Product/Index', ['products' => $products, 'brands' => $brands, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        // dd($request->file('product_images'));
        $product = new Product();
        $product->title = $request->title;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->save();

        // check if product has images
        if ($request->hasFile('product_images')) {
            $productImages = $request->file('product_images');

            foreach ($productImages as $image) {
                // Generating a unique name for the image using timestamp and random string
                $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();

                // Store the image in the public foler with the unique name
                $image->move('product_images', $uniqueName);

                // Create a new product image record with product_id and unique name 
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'product_images/' . $uniqueName,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Product added successfully!');

    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;


        // check if product has images
        if ($request->hasFile('product_images')) {
            $productImages = $request->file('product_images');

            foreach ($productImages as $image) {
                // Generating a unique name for the image using timestamp and random string
                $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();

                // Store the image in the public foler with the unique name
                $image->move('product_images', $uniqueName);

                // Create a new product image record with product_id and unique name 
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'product_images/' . $uniqueName,
                ]);
            }
        }
        $product->update();
        return redirect()->back()->with('success', 'Product updated successfully!');
    }

    public function deleteImg($id)
    {
        $image = ProductImage::where('id', $id)->delete();
        return redirect()->route('admin.products.index')->with('success', 'Image deleted successfully!');
    }

    // delete the product 
     public function destroy($id)
     {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully!');
     }
}
