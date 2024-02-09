<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;

class TaskController extends Controller
{
    //
    public function index(){
        $intern = Tasks::where('status', 'Active')->get();

        return view ('index', compact('intern'));
    }

}
