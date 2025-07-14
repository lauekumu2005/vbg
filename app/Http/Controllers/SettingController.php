<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function create()
    {
        return view('settings.create');
    }

    public function store(Request $request)
    {
        // Logique de stockage
    }

    public function show($id)
    {
        return view('settings.show', compact('id'));
    }

    public function edit($id)
    {
        return view('settings.edit', compact('id'));
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