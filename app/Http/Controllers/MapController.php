<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        return view('map.index');
    }

    public function create()
    {
        return view('map.create');
    }

    public function store(Request $request)
    {
        // Logique de stockage
    }

    public function show($id)
    {
        return view('map.show', compact('id'));
    }

    public function edit($id)
    {
        return view('map.edit', compact('id'));
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