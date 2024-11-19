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

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
	
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return view('dashboards.index');
    }
}
