<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\ImageService;
 
 

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.Dynamic.Category');
    }

    public function fetch()
    {
        $Categories = Category::all();
        return response()->json(['Categories' => $Categories]);
    }
    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreCategoryRequest $request )
    {
        $validated = $request->validated();

        Category::create($validated);

        return response()->json(['message' => ' Category Added Successfully']);
    }
    // public function store(StoreCategoryRequest $request)
    // {
    //     $Category = new Category;
    //     $validated = $request->validated();

    //     if ($request->hasFile('image')) {
    //         $imagePath = $Category->uploadImage($Category, 'Categories', $request->file('image'));
    //     }

    //     // Save other fields
    //     $Category->name = $validated['name'];
    //     $Category->description = $validated['description'];
    //     $Category->image = $imagePath;
    //     $Category->save();

    //     return response()->json([
    //      'success' => true,
    //       'message' => ' Category added successfully',
    //     ]);
    // }


    /**
     * Show the model for editing the specified resource.
     */
    public function edit(Category $Category)
    {
        
        return response()->json(['Category' => $Category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $Category)
    {
        $validated = $request->validated();
        $Category->update($validated);

        return response()->json(['message' => ' Category Updated Successfully']);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $Category)
    {

        $Category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
