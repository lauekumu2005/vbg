<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CasesController extends Controller
{
    public function index()
    {
        return view('cases.list');
    }

    public function followUp()
    {
        return view('cases.follow-up');
    }
} 