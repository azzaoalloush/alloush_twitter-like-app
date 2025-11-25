<?php

namespace App\Http\Controllers;

use App\Models\User;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $ideas = $user->ideas()->withCount('likes')->latest()->get();

        $stats = [
            'idea_count' => $user->ideas()->count(),
            'total_likes_received' => $user->ideas()->withCount('likes')->get()->sum('likes_count'),
            'joined' => $user->created_at,
        ];

        return view('profile.show', compact('user', 'ideas', 'stats'));
    }
}
