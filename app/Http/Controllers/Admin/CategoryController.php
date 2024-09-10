<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        //get categories
        $categories = Category::all();

        return view('admin.category.list', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'txtCateName' => 'required',
            ], 
            [
                'txtCateName.required' => 'The category name is required!',
            ]
        );

        $slug = Str::slug($request->txtCateName);

        $checkSlug = Category::where('slug', $slug)->first();

        while ($checkSlug) {
            $slug = $checkSlug->slug . Str::random(2);
        }

        Category::create([
            'name' => $request->txtCateName,
            'slug' => $slug,
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Create Successfully');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'txtCateName' => 'required',
            ], 
            [
                'txtCateName.required' => 'The category name is required!',
            ]
        );

        $slug = Str::slug($request->txtCateName);

        $checkSlug = Category::where('slug', $slug)->first();

        while ($checkSlug) {
            $slug = $checkSlug->slug . Str::random(2);
        }

        Category::where('id', $id)->update([
            'name' => $request->txtCateName,
            'slug' => $slug,
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Edit Successfully');
    }

    public function delete($id)
    {
        Category::where('id', $id)->delete();
        return redirect()->route('admin.category.index')->with('success','Delete Successfully');
    }
}
