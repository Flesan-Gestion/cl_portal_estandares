<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function redirectToProvider()
    {

        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {

        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = $this->repository->getUserByEmail($googleUser->email);

            $claims = array();

            if ($user == null) {
                return redirect('/error/403');
            } else {
                $claims['user'] = $user;
            }

            $token = JWTAuth::claims($claims)->fromUser($user);
            Cache::put('token_' . $googleUser->email, $token);

            return redirect("/redirect/" . $googleUser->email);
        } catch (ClientException $exception) {
            return redirect('/error/422');
        }
    }


    public function getToken($email)
    {
        // dd($token);
        $token = Cache::get('token_' . $email);
        Cache::forget('token_' . $email);
        return $token;
    }
}
