<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BlogPost;



class BlogPostController extends Controller
{
    //Get a single blog post
    public function show($id)
    {
        $blogPost = BlogPost::findOrFail($id);
        return response()->json($blogPost);
    }

    public function index()
    {
        $blogPosts = BlogPost::all();
        return response()->json($blogPosts);
    }

}
