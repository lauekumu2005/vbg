<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return view('notifications.index');
    }

    public function create()
    {
        return view('notifications.create');
    }

    public function store(Request $request)
    {
        // Logique de stockage
    }

    public function show($id)
    {
        return view('notifications.show', compact('id'));
    }

    public function edit($id)
    {
        return view('notifications.edit', compact('id'));
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