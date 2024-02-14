<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(Post $post){
        $this->model = $post;
    }

    public function view(){
        return view ('posts.list',[
            'posts' => Post::all(),
        ]);
    }

    public function create(){
        return view ('posts.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' =>'required',
            'description' =>'required',
        ]);

        $this->model->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return redirect()->route('post.view');
    }
}
