<?php

namespace App\Http\Controllers;

use App\Models\User;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $user->loadCount(['followers', 'following', 'forumPosts']);

        return view('profile.show', compact('user'));
    }
}
