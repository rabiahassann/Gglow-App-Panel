<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    
    public function index()
    {
        try {
            $products = Product::paginate(4);
                return view('products.index', compact('products'));
        } catch (\Exception $e) {
            \Log::error('Error fetching categories: ' . $e->getMessage());
                return redirect()->route('products.index')->with('error', 'Something went wrong while fetching categories.');
        }
    }

     public function create(){
        try {
        $categories = Category::all();
        return view('products.create',compact('categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! ' . $e->getMessage());
     }
    }

    public function store(Request $request)
{


    try {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'name' => 'required|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'location' => 'required',
            'number' => 'required|string',
            'overview' => 'required',
            'entry_access' => 'required',
            'exlusive_benefits' => 'required',
            'kids_nannyxs' => 'required',
            'listing_type' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Upload Other Images
        $otherImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $otherImages[] = $image->store('listing', 'public');
            }
        }

        $product = Product::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->sub_category_id,
            'name' => $request->name,
            'images' => json_encode($otherImages), 
            'price' => $request->price,
            'location' =>  $request->location,
            'number' =>  $request->number,
            'overview' => $request->overview,
            'entry_access' => $request->entry_access,
            'exlusive_benefits' => $request->exlusive_benefits,
            'kids_nannyxs' => $request->kids_nannyxs,
            'type' => json_encode($request->listing_type ?? [])

        ]);

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    } catch (\Exception $e) {
        // Log detailed error information
        \Log::error('Product Store Error: ' . $e->getMessage(), [
            'exception' => $e,
            'request_data' => $request->all(),
        ]);
        return redirect()->back()->with('error', 'Something went wrong! Please try again.');
    }
}

 public function edit($id){
        try{
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $product = Product::with('category','subcategory')->findOrFail($id);
        return view('products.edit',compact('product','categories','subcategories'));
        }

        catch (\Exception $e) {
            \Log::error('Product Store Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }

}

public function update(Request $request, $id)
{
    try {
        $product = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'category_id'        => 'required|exists:categories,id',
            'sub_category_id'    => 'nullable|exists:sub_categories,id',
            'name'               => 'required|string|max:255',
            'images.*'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price'              => 'required|numeric|min:0',
            'location'           => 'required|string',
            'number'             => 'required|string',
            'overview'           => 'required|string',
            'entry_access'       => 'required|string',
            'exlusive_benefits'  => 'required|string',
            'kids_nannyxs'       => 'required|string',
            'listing_type'       => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $existingImages = is_array($product->images) ? $product->images : json_decode($product->images, true) ?? [];
        $newImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $newImages[] = $image->store('listing', 'public');
            }
        }
        $allImages = array_merge($existingImages, $newImages);
        $product->update([
            'category_id'        => $request->category_id,
            'subcategory_id'     => $request->sub_category_id,
            'name'               => $request->name,
            'images'             => json_encode($allImages),
            'price'              => $request->price,
            'location'           => $request->location,
            'number'             => $request->number,
            'overview'           => $request->overview,
            'entry_access'       => $request->entry_access,
            'exlusive_benefits'  => $request->exlusive_benefits,
            'kids_nannyxs'       => $request->kids_nannyxs,
            'type'               => json_encode($request->listing_type ?? []),
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    } catch (\Exception $e) {
        \Log::error('Product Update Error: ' . $e->getMessage(), [
            'exception' => $e,
            'request_data' => $request->all(),
        ]);

        return redirect()->back()->with('error', 'Something went wrong! Please try again.');
    }
}

public function destroy($id)
{
    try {
        $product = Product::findOrFail($id);
        if (!empty($product->images)) {
            $images = is_array($product->images) ? $product->images : json_decode($product->images, true);

            if (is_array($images)) {
                foreach ($images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    } catch (\Exception $e) {
        \Log::error('Product Delete Error: ' . $e->getMessage(), [
            'exception' => $e,
            'product_id' => $id,
        ]);

        return redirect()->back()->with('error', 'Something went wrong while deleting the product.');
    }
}








}
