<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getUserAvatar(string $user_id) {
        if (env('FILESYSTEM_DISK') == 's3'){
            if(Storage::disk('s3')->exists('public/avatar-' . $user_id . '.png')) {
                $avatarUrl = Storage::temporaryUrl(
                    'public/avatar-' . $user_id . '.png', now()->addMinutes(5)
                );
            } else {
                $path = public_path();
                $avatarUrl = "/img/default.png";
            }
        }

        if(env('FILESYSTEM_DISK') == 'local') {
            if(Storage::disk('local')->exists('public/avatar-' . $user_id . '.png')) {
                $avatarUrl = Storage::url('public/avatar-' . $user_id . '.png');
            } else {
                $path = public_path();
                $avatarUrl = "/img/default.png";
            }
        }

        return $avatarUrl;
    }
}
