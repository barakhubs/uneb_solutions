<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Resource;
use App\Models\Subject;
use App\Models\Tags;
use App\Models\Download;
use App\Models\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $classes    = Classes::get();
        $subjects   = Subject::get();
        $tags       = Tags::get();
        $resources  = Resource::paginate(10);
        // recent resources
        $recent = Resource::latest()->paginate(6);
        // most popular
        /* selecting by number of downloads */

        $popular    = View::orderby('count', 'DESC')->paginate(6);

        // free resources
        $free       = Resource::where('price', '0')->paginate(6); 
        
        return view ('home', compact(
            'resources', 
            'classes', 
            'tags', 
            'subjects', 
            'recent',
            'popular',
            'free'
        ));
    }
}
