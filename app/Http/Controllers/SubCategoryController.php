<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
class SubCategoryController extends Controller
{
    
     public function index()
    {
        try {
            $categories = SubCategory::paginate(4);
                return view('subcategories.index', compact('categories'));
        } catch (\Exception $e) {
            \Log::error('Error fetching categories: ' . $e->getMessage());
                return redirect()->route('dashbord')->with('error', 'Something went wrong while fetching categories.');
        }
    }

     public function addCategory()
    {
        try {
            $categories = Category::all();
            return view('subcategories.create', compact('categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

     public function store(Request $request)
{
    
    try {
        $request->validate([
            'category_id',
            'name' => 'required',
            'image' => 'nullable',
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public'); 
        }

        SubCategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'image' => $imagePath,
        ]);

        return redirect()->route('subcategories.index')->with('success', 'Category created successfully!');
    } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Something went wrong! ' . $e->getMessage());
    }
}

public function edit($id)
{
    try {
        $subcategory = SubCategory::with('category')->findOrFail($id);
        $categories = Category::all();
        return view('subcategories.edit', compact('subcategory','categories'));
    } catch (\Exception $e) {
        return redirect()->route('subcategories.index')->with('error', 'Category not found: ' . $e->getMessage());
    }
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    try {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->fill($validated);

        if ($request->hasFile('image')) {
            $subcategory->image = $request->file('image')->store('subcategories', 'public');
        }

        $subcategory->save();

        return redirect()->route('subcategories.index')->with('success', 'Subcategory updated successfully.');

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException) {
        return redirect()->route('subcategories.index')->with('error', 'Subcategory not found.');

    } catch (\Exception $e) {
        return back()->with('error', 'Something went wrong! Please try again.')->withInput();
    }
}


public function destroy($id)
{
    try {
        $category = SubCategory::findOrFail($id);
        $category->delete();
        return redirect()->route('subcategories.index')->with('success', 'Category deleted successfully!');
    } catch (\Exception $e) {
        return redirect()->route('subcategories.index')->with('error', 'Failed to delete category: ' . $e->getMessage());
    }
}



}
