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
        $user = Socialite::driver('line-login')->user();

        $loginUser = UserController::updateLineUserIdSettings([
            'line_user_id' => $user->id,
            'line_name' => $user->nickname,
            'line_avatar' => $user->avatar,
            'line_access_token' => $user->token,
            'line_refresh_token' => $user->refreshToken,
        ]);

        // auth()->login($loginUser, true);

        return redirect()->route('home');
    }
}