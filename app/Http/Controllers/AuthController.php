<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Arr;
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



            if ($user == null) {
                return redirect('/error/403');
            } else {
                $this->repository->update($user->id_aplicacion_usuario, array("avatar" => $googleUser->avatar));
                $user->avatar = $googleUser->avatar;
                $claims = array();
                $claims['user'] = $user;
            }

            $token = JWTAuth::claims($claims)->fromUser($user);
            Cache::put('token_' . $googleUser->email, $token, 60);

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
