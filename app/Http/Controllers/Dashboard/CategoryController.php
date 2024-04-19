<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents =Category::all();
        return view('dashboard.categories.create' , compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(["slug"=>Str::slug($request->name)]);

        Category::create($request->all());
        return redirect()->route('dashboard.categories.index')->with('success' , 'Category Created Successfully!');

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
    public function edit($id)
    {
        $category = Category::findorfail($id);
        $parents = Category::where("id","<>",$id)
            ->where(function ($query) use($id){
               $query->whereNull('parent_id')
                     ->orWhere('parent_id' ,'<>',$id);
            })
            ->get();
        return view('dashboard.categories.edit' , compact('category','parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findorfail($id);
        $category->update($request->all());
        return redirect()->route('dashboard.categories.index')->with('success' , 'Category Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::destroy($id);
        return redirect()->route('dashboard.categories.index')->with('success' , 'Category deleted Successfully!');
    }
}
