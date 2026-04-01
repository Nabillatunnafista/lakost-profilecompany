<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area; 
use App\Models\Team;

class PageController extends Controller
{
    public function home() 
    {
        $areas = Area::all(); 
        return view('home', compact('areas')); 
    }

    public function about() 
    {
        $team = Team::all(); 
        return view('about', compact('team')); 
    }

    public function contact() 
    {
        return view('contact'); 
    }
}