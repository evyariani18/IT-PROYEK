<?php

namespace App\Http\Controllers;

//import model product
use App\Models\Brand;

//post 
use App\Models\Post;

 //import return type View
use Illuminate\View\View;

//import class
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home(){
		return view('home');
	}

	public function tentang(){
		return view('tentang');
	}

	public function kontak(){
		return view('kontak');
	}
}
