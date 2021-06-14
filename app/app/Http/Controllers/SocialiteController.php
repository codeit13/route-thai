<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function linelogin()
    {
        return Socialite::driver('line-login')->redirect();
    }

    public function callback(Request $request)
    {
        if ($request->missing('code')) {
            dd($request);
        }

        /**
         * @var \Laravel\Socialite\Two\User
         */
        $user = Socialite::driver('line-notify')->user();

        $request->user()
            ->fill([
                'notify_token' => $user->token
            ])->save();

        return redirect()->route('home');
    }
}