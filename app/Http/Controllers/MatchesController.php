<?php

namespace App\Http\Controllers;

use App\User;

class MatchesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function matches()
    {
        $user = auth()->user();
        $userSettings = $user->settings;
        $id = $user->id;

        $users = User::searchMatches($id)
            ->get();

        return view('matches', [
            'users' => $users,
            'user' => $user,
        ]);
    }

    public function likes()
    {
        $user = auth()->user();
        $userSettings = $user->settings;
        $id = $user->id;

        $users = User::searchLikes($id)
            ->get();

        return view('likes', [
            'users' => $users,
            'user' => $user,
        ]);
    }
}
