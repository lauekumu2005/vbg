<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Accompaniment;
use App\Models\Report;
use Illuminate\Support\Facades\DB;

class MinistereController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'active_accompaniments' => Accompaniment::where('status', 'active')->count(),
            'total_reports' => Report::count(),
            'recent_activities' => DB::table('activities')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get()
        ];

        return view('ministere.dashboard', compact('stats'));
    }

    public function statistics()
    {
        $monthlyStats = DB::table('accompaniments')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->get();

        $categoryStats = DB::table('accompaniments')
            ->select('category', DB::raw('COUNT(*) as total'))
            ->groupBy('category')
            ->get();

        return view('ministere.statistics', compact('monthlyStats', 'categoryStats'));
    }

    public function reports()
    {
        $reports = Report::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('ministere.reports', compact('reports'));
    }

    public function users()
    {
        $users = User::withCount('accompaniments')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('ministere.users', compact('users'));
    }

    public function accompaniments()
    {
        $accompaniments = Accompaniment::with(['user', 'mentor'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('ministere.accompaniments', compact('accompaniments'));
    }

    public function settings()
    {
        return view('ministere.settings');
    }

    public function profile()
    {
        return view('ministere.profile');
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|max:20',
            'position' => 'nullable|string|max:100',
            'bio' => 'nullable|string|max:500',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = auth()->user();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? null;
        $user->position = $validated['position'] ?? null;
        $user->bio = $validated['bio'] ?? null;

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar_url = $path;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil mis à jour avec succès');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = auth()->user();
        $user->password = bcrypt($validated['password']);
        $user->save();

        return redirect()->back()->with('success', 'Mot de passe mis à jour avec succès');
    }

    public function updatePreferences(Request $request)
    {
        $validated = $request->validate([
            'email_notifications' => 'boolean',
            'sms_notifications' => 'boolean',
            'push_notifications' => 'boolean'
        ]);

        $user = auth()->user();
        $user->email_notifications = $request->boolean('email_notifications');
        $user->sms_notifications = $request->boolean('sms_notifications');
        $user->push_notifications = $request->boolean('push_notifications');
        $user->save();

        return redirect()->back()->with('success', 'Préférences mises à jour avec succès');
    }
} 