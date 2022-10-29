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

        if (env('FILESYSTEM_DISK') == 's3'){
            if(Storage::disk('s3')->exists('public/avatar-' . $user->id . '.png')) {
                $avatarUrl = Storage::temporaryUrl(
                    'public/avatar-' . $user->id . '.png', now()->addMinutes(5)
                );
            } else {
                $path = public_path();
                $avatarUrl = "/img/default.png";
            }
        }

        if(env('FILESYSTEM_DISK') == 'local') {
            if(Storage::disk('local')->exists('public/avatar-' . $user->id . '.png')) {
                $avatarUrl = Storage::url('public/avatar-' . $user->id . '.png');
            } else {
                $path = public_path();
                $avatarUrl = "/img/default.png";
            }
        }

        return view('profile', ['user' => Auth::user(), 'avatarUrl' => $avatarUrl]);
    }
}
