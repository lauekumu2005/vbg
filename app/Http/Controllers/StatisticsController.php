<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        return view('statistics.index');
    }

    public function create()
    {
        return view('statistics.create');
    }

    public function store(Request $request)
    {
        // Logique de stockage
    }

    public function show($id)
    {
        return view('statistics.show', compact('id'));
    }

    public function edit($id)
    {
        return view('statistics.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Logique de mise à jour
    }

    public function destroy($id)
    {
        // Logique de suppression
    }
} 