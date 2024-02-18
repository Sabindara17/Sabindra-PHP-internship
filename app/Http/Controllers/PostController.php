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
            'title' =>['required','min:5'],
            'description' =>['required','min:10'],
        ]);
        try{
            $this->model->create([
                'title' => $request->title,
                'description' => $request->description,
            ]);
            return redirect()->route('post.view')->with('success','Post added Successfully');
        }catch(\Exception $e){
            return redirect()->back()->withInput()->withErrors(['error'=>'There is an issue making post. Please contact admin ']);

        }

        return redirect()->route('post.view')->with('success', 'Post added successfully');
    }
    public function edit($postid){
        $post = Post::find($postid);
        if(!$post){
            return redirect()->route('post.view')->with('error', 'Post not found');
        }
        return view('posts.edit',[
            'post' =>  $post,
        ]);

    }

    public function update(Request $request,$postid){
        $post = Post::find($postid);
        if(!$post){
            return redirect()->route('post.view')->with('error', 'Post not found');
        }
        $request->validate([
            'title' =>['required','min:5'],
            'description' =>['required','min:10'],
        ]);
        try{
            $post->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
            ]);
            return redirect()->route('post.view')->with('success', 'Post edited successfully');

        }catch(\Exception $e){
            return redirect()->back()->withInput()->withErrors(['error'=>'There is an issue making post. Please contact admin ']);
        }
        return redirect()->route('post.view')->with('success', 'Post edited successfully');


    }

    public function destroy($postid){
        $deleted = Post::find($postid)->delete();
        if($deleted){
            $msg = array(
                'status' => true,
                'message' => 'Post deleted'
            );
        }else{
            $msg = array(
                'status' => false,
                'message' => 'Post cannot be deleted.'
            );
        }

        return json_encode($msg);
    }
}
