<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function index()
    {
        return view('admin.advertisements.index');
    }
}
