<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wilayah;

class WilayahApiController extends Controller
{
    public function index()
    {
        return response()->json(Wilayah::all());
    }
}