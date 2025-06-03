<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
class CategoryController extends Controller
{
    //

     public function index()
    {
        try {
            $categories = Category::paginate(4);
                return view('categories.index', compact('categories'));
        } catch (\Exception $e) {
            \Log::error('Error fetching categories: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Something went wrong while fetching categories.');
        }
    }

    public function addCategory(){
        return view('categories.create');
    }

     public function store(Request $request)
{
    
    try {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable',
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public'); // Store in storage/app/public/categories
        }

        Category::create([
            'name' => $request->name,
            'image' => $imagePath,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Something went wrong! ' . $e->getMessage());
    }
}

public function edit($id)
{
    try {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    } catch (\Exception $e) {
        return redirect()->route('categories.index')->with('error', 'Category not found: ' . $e->getMessage());
    }
}

public function update(Request $request, $id)
{
    try {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,jfif|max:2048',
        ]);
        $category = Category::findOrFail($id);
        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $imagePath = $request->file('image')->store('categories', 'public');
        } else {
            $imagePath = $category->image;
        }
        $category->update([
            'name' => $request->name,
            'image' => $imagePath,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    } catch (\Exception $e) {
        return redirect()->route('categories.index')->with('error', 'Something went wrong! ' . $e->getMessage());
    }
}

public function destroy($id)
{
    try {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    } catch (\Exception $e) {
        return redirect()->route('categories.index')->with('error', 'Failed to delete category: ' . $e->getMessage());
    }
}



// get api
public function getcategories()
{
    try {
        $categories = Category::all();
        return response()->json([
            'status' => true,
            'data' => $categories
        ]);
    } catch (\Exception $e) {
        Log::error('Error fetching categories: ' . $e->getMessage());
        return response()->json([
            'status' => false,
            'message' => 'Failed to fetch categories.'
        ], 500);
    }
}

// get subcategories api
public function getsubcategories($id)
{
    try {
        $subcategories = SubCategory::where('category_id', $id)->get();
        return response()->json([
            'status' => true,
            'data' => $subcategories
        ]);
    } catch (\Exception $e) {
        Log::error("Error fetching subcategories for category_id $id: " . $e->getMessage());
        return response()->json([
            'status' => false,
            'message' => 'Failed to fetch subcategories.'
        ], 500);
    }
}


// listing api
public function getfilterproducts(Request $request, $id = null, $type = null)
{
    try {
        $categoryId = $request->input('category_id') ?? $id;
        $subcategoryId = $request->input('subcategory_id');
        $type = $request->input('type') ?? $type;

        $query = Product::query();

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($subcategoryId) {
            $query->where('subcategory_id', $subcategoryId);
        }

        if ($type) {
            $types = explode(',', $type);
            $query->get()->each(function ($product) {
                if (is_string($product->type)) {
                    $decoded = json_decode($product->type, true);
                    if (is_array($decoded)) {
                        $product->type = $decoded;
                        $product->save();
                    }
                }
            });

            $query->where(function ($q) use ($types) {
                foreach ($types as $t) {
                    $q->orWhereJsonContains('type', $t);
                }
            });
        }

        $products = $query->get();

        return response()->json([
            'status' => true,
            'data' => $products
        ]);

    } catch (\Exception $e) {
        Log::error('Error fetching filtered products: ' . $e->getMessage());
        return response()->json([
            'status' => false,
            'message' => 'Failed to fetch products.'
        ], 500);
    }
}






}