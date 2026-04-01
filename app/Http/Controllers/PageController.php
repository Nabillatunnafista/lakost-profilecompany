<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area; // Tambahkan ini agar data Area bisa diambil
use App\Models\Team; // Tambahkan ini agar data Team bisa diambil

class PageController extends Controller
{
    // Ini adalah method 'home' yang dicari Laravel tadi
    public function home() 
    {
        $areas = Area::all(); // Mengambil data kecamatan dari database
        return view('home', compact('areas')); // Membuka file home.blade.php
    }

    // Pastikan about juga ada agar tidak error lagi nanti
    public function about() 
    {
        $team = Team::all(); // Mengambil data tim
        return view('about', compact('team')); // Membuka file about.blade.php
    }

    // Dan contact juga
    public function contact() 
    {
        return view('contact'); // Membuka file contact.blade.php
    }
}