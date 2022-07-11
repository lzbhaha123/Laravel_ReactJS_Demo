<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Post;
use \App\Models\Tag;

class HomeController extends Controller
{
    function index(){
        $posts = Post::with('tags')->get(['id','title','picture']);
        $tags = Tag::all();
        //$posts = Post::find(1)->tags()->get();
        return view('home.index')->with(['posts'=>$posts,'tags'=>$tags]);
    }
}
