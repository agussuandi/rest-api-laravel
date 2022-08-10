<?php

namespace App\Http\Services\Auth;

use DB;
use Hash;
use AuthToken;

use App\Http\Resources\User\UserResource;

use App\Models\User;
use App\Models\PersonalAccessToken\PersonalAccessToken;

class AuthServices
{
    public function checkLogin($request)
    {
        $user = User::where(function($query) use($request) {
            $query->orWhere('username', $request->input('identity'))->orWhere('email', $request->input('identity'));
        })->first();

        if (!$user)
            abort(401, "User Not found. Invalid username or email.");

        if (!(Hash::check($request->input('password'), $user->password)))
            abort(401, "Invalid password.");

        return AuthToken::generateToken($user);
    }

    public function register($request)
    {
        $data = DB::transaction(function () use ($request) {
            $user             = new User;
            $user->name       = $request->input('name');
            $user->username   = $request->input('username');
            $user->email      = $request->input('email');
            $user->password   = Hash::make($request->input('password'));
            $user->created_at = now();
            $user->save();

            return $user;
        });

        return new UserResource($data);
    }

    public function refreshToken($request)
    {
        $user = User::getIdentityToken($request->bearerToken());
        return AuthToken::refreshToken($user, $request->bearerToken());
    }

    public function currentUser($request)
    {
        $tokenIdentity = User::getIdentityToken($request->bearerToken());
        $user = User::find($tokenIdentity->userId);

        return new UserResource($user);
    }

    public function destroyToken($request)
    {
        return AuthToken::destroyToken($request->bearerToken());
    }
}
