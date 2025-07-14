<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        return view('reports');
    }

    public function abuse()
    {
        return view('reports.abuse');
    }
} 