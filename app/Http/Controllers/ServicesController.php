<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function offers()
    {
        return view('services.offers');
    }
} 