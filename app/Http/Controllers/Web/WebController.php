<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;

class WebController extends Controller
{
    public function home()
    {
        $highlight = Post::where('highlight_post', 1)->take(3)->get();
        $new = Post::where('new_post', 1)->take(10)->get();
        return view('web.home', compact('highlight','new'));
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $post->update([
            'view_counts' => $post->view_counts+1,
        ]);

        $relates = Post::where('category_id', $post->category_id)->take(2)->inRandomOrder()->get();

        $comments = Comment::where('post_id', $post->id)->paginate(10);

        return view('web.post', compact('post', 'relates', 'comments'));
    }

    public function comment(Request $request, $post_id)
    {
        Comment::create([
            'content' => $request->content,
            'post_id' => $post_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back();
    }

    public function category()
    {
        $categories = Category::all();
        $posts = Post::paginate(10);
        return view('web.category', compact('categories','posts'));
    }

    public function categorySlug($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $posts = Post::where('category_id', $category->id)->paginate(10);
        $categories = Category::all();
        return view('web.category', compact('categories','posts'));
    }

    public function contact()
    {
        return view('web.contact');
    }

    public function sendContact(Request $request)
    {
        $data = [
            'name' => htmlspecialchars($request->name),
            'address' => htmlspecialchars($request->address),
            'phone' => htmlspecialchars($request->phone),
            'subject' => htmlspecialchars($request->subject),
            'message' => htmlspecialchars($request->message),
        ];
        Contact::create($data);

        return redirect()->route('web.contact')->with('success','Send Contact Successfully');
    }
}
