<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create' , compact('category','parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required|string|min:3|max:255',
            'parent_id'=>'nullable|int|exists:categories,id',
            'description'=>'nullable|min:15',
            'image'=>'image|max:1048576|dimensions:min_width=100,min_height=100',
            'status'=>'in:active,archived',
        ]);

        $request->merge(["slug"=>Str::slug($request->name)]);

        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);
        $category = Category::create($data);
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
        $old_image = $category->image;
        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);

        $category->update($data);
        if ($old_image && $data['image'])
        {
            Storage::disk('public')->delete($old_image);
        }
        return redirect()->route('dashboard.categories.index')->with('success' , 'Category Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        Category::destroy($id);
        $category= Category::findorFail($id);
        $category->delete();

        if ($category->image)
        {
            Storage::disk("public")->delete($category->image);
        }
        return redirect()->route('dashboard.categories.index')->with('success' , 'Category deleted Successfully!');
    }

    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image'))
        {
            return;
        }
        $file = $request->file('image'); //uploadFile object
        $path = $file->store('Category' , 'public');
        return $path;
    }
}
