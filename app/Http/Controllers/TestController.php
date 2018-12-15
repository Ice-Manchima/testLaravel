<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function home(){
        $task = [
            'Contact',
            'About',
            'Project',
        ];

        return view('welcome')->withTasks($task);
    }

    public function about(){

        return view('about');
    }

    public function contact(){

        return view('contact');
    }
}
