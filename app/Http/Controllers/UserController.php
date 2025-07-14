<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Logique de stockage
    }

    public function show($id)
    {
        return view('users.show', compact('id'));
    }

    public function edit($id)
    {
        return view('users.edit', compact('id'));
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