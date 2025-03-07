<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function show(){
        $blogs = Blog::orderBy("id","desc")->paginate(10);
        return view("frontend.blog",compact('blogs')); 
    }
    public function index(){
        $blogs = Blog::orderBy("id","desc")->paginate(10);
        return view("backend.blog",compact('blogs')); 
    }
}
