<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\GenerateBlogPostJob;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function BlogList()
    {
        $blogs = Blog::latest()->get();
        return view('admin.backend.blogs.blog_list', compact('blogs'));
    }

    public function AdminBlogsCreate()
    {
        return view('admin.backend.blogs.blog_create');
    }
    //End Method 

    public function AdminBlogsStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string'
        ]);

        $blog = Blog::create([
            'title' => $request->title,
            'status' => 'pending',
        ]);

        GenerateBlogPostJob::dispatch($blog);

        $notification = array(
            'message' => 'Blog post generate Successfully It may takes little time',
            'alert-type' => 'success'
        );
        return redirect()->route('blog.list')->with($notification);
    }

    public function AdminBlogsShow(Blog $blog)
    {
        return view('admin.backend.blogs.blog_show', compact('blog'));
    }
}
