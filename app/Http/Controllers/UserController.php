<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //
    public function profile()
    {
        $userId = Auth::id();

        $user = User::find($userId);

        $avatarUrl = $this->getUserAvatar($userId);

        return view('profile', ['user' => Auth::user(), 'avatarUrl' => $avatarUrl]);
    }
}
