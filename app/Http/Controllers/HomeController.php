<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Resource;
use App\Models\Subject;
use App\Models\Tags;
use App\Models\Download;
use App\Models\View;
use Illuminate\Support\Facades\DB;

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
        $popularClasses = Classes::leftJoin('resources', 'classes.id', '=', 'resources.class_id')
        ->select('classes.id', 'classes.class', 'classes.slug', DB::raw('COUNT(resources.id) as resource_count'))
        ->groupBy('classes.id', 'classes.class', 'classes.slug')
        ->orderByDesc('resource_count')
        ->limit(5)
        ->get();

        $classes    = Classes::get();
        $subjects   = Subject::get();
        $tags       = Tags::get();
        $resources  = Resource::paginate(10);
        $old_curriculum = Resource::where('curriculum', 'old')->paginate(6);
        $new_curriculum = Resource::where('curriculum', 'new')->paginate(6);
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
            'free',
            'popularClasses',
            'old_curriculum',
            'new_curriculum'
        ));
    }
}
