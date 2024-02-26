<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(){

    }

    public function index(){
        //posts->comment
        $posts= Post::all();


        return view ('index',[
            'posts' => $posts,
        ]);
    }
}
