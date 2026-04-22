<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;

class KategoriApiController extends Controller
{
    public function index()
    {
        return response()->json(Kategori::all());
    }
}