<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function index(){
        $posts = Post::with(['user','comments'])->orderBy("created_at","desc")->paginate(10);
        // return $posts;
        return view("frontend.community", compact("posts"));
    }
}
