<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
     public function BlogList(){
        $blogs = Blog::latest()->get();
        return view('admin.backend.blogs.blog_list',compact('blogs'));
    }
}
