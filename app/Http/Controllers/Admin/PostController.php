<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(20);

        return view("admin.post.list", compact("posts"));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.post.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'image' => 'required|image',
                'category_id' => 'required',
                'title' => 'required',
                'description' => 'required',
                'content' => 'required',
            ],
            [
                'image.image' => 'Only accept image file',
                'image.required' => 'Image is required',
                'title.required' => 'Title is required',
                'description.required' => 'Description is required',
                'content' => 'Content is required',
            ]
        );

        $slug = Str::slug($request->title);

        $checkSlug = Category::where('slug', $slug)->first();

        while ($checkSlug) {
            $slug = $checkSlug->slug . Str::random(2);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = $file->getClientOriginalName();

            do {
                $image = Str::random(5) . '-' . $file_name;
            } while (file_exists('image/post' . $image));

            $file->move('image/post', $image);
        }

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'view_counts' => 0,
            'user_id' => Auth::user()->id,
            'new_post' => $request->new_post == 'on' ? 1 : 0,
            'slug' => $slug,
            'category_id' => $request->category_id,
            'highlight_post' => $request->highlight_post == 'on' ? 1: 0,
        ]);

        return redirect()->route('admin.post.index')->with('success','Create Successfully!');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return view('admin.post.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'image' => 'image',
                'category_id' => 'required',
                'title' => 'required',
                'description' => 'required',
                'content' => 'required',
            ],
            [
                'image.image' => 'Only accept image file',
                'title.required' => 'Title is required',
                'description.required' => 'Description is required',
                'content' => 'Content is required',
            ]
        );

        $slug = Str::slug($request->title);

        $checkSlug = Category::where('slug', $slug)->first();

        while ($checkSlug) {
            $slug = $checkSlug->slug . Str::random(2);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = $file->getClientOriginalName();

            do {
                $image = Str::random(5) . '-' . $file_name;
            } while (file_exists('image/post' . $image));

            $file->move('image/post', $image);
        }

        $post = Post::find($id);

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => isset($image) ? $image : $post->image,
            'new_post' => $request->new_post == 'on' ? 1 : 0,
            'slug' => $slug,
            'category_id' => $request->category_id,
            'highlight_post' => $request->highlight_post == 'on' ? 1: 0,
        ]);

        return redirect()->route('admin.post.index', $id)->with('success','Update Successfully');
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        return redirect()->route('admin.post.index')->with('success', 'Delete Successfully');
    }
}
