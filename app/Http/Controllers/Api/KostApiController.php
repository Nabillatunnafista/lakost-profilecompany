<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kost;

class KostApiController extends Controller
{
    public function index()
    {
        return Kost::with(['kategori', 'wilayah'])->get();
    }

    public function show($id)
    {
        return Kost::with(['kategori', 'wilayah'])->findOrFail($id);
    }
}