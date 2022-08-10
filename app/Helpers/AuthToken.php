<?php

namespace App\Helpers;

use DB;
use Exception;

use App\Models\PersonalAccessToken\PersonalAccessToken;

class AuthToken
{
    public static function generateToken($user): array
    {
        try
        {
            $userData = [
                'userId'    => $user->id,
                'name'      => $user->name,
                'email'     => $user->email,
                'username'  => $user->username,
            ];

            $token = encrypt($userData);

            $dataToken = DB::transaction(function () use ($token) {
                $personalAccessToken                 = new PersonalAccessToken;
                $personalAccessToken->token          = $token;
                $personalAccessToken->flag_active    = PersonalAccessToken::ACTIVE;
                $personalAccessToken->expired_at     = date('Y-m-d H:i:s', strtotime(now() .' +1 day'));
                $personalAccessToken->created_at     = now();
                $personalAccessToken->save();

                return $personalAccessToken;
            });

            return [
                'status'    => true,
                'token'     => $token,
                'expiredAt' => $dataToken->expired_at,
                'user'      => $userData
            ];
        }
        catch (Exception $e)
        {
            return [
                'status'  => false,
                'message' => 'Failed generate token',
                'error'  => $e->getMessage()
            ];
        }
    }

    public static function refreshToken($user, $currentToken): array
    {
        try
        {
            $newToken = encrypt($user);
            $expiredAt = date('Y-m-d H:i:s', strtotime(now() .' +1 day'));


            $dataToken = DB::transaction(function () use ($newToken, $expiredAt, $currentToken) {
                PersonalAccessToken::where('token', $currentToken)->update([
                    'token'      => $newToken,
                    'updated_at' => now(),
                    'expired_at' => $expiredAt
                ]);
            });

            return [
                'status'    => true,
                'token'     => $newToken,
                'expiredAt' => $expiredAt,
                'user'      => $user
            ];
        }
        catch (Exception $e)
        {
            return [
                'status'  => false,
                'message' => 'Failed refresh token',
                'error'  => $e->getMessage()
            ];
        }
    }

    public static function destroyToken($token): array
    {
        try
        {
            $dataToken = DB::transaction(function () use ($token) {
                PersonalAccessToken::where('token', $token)->update([
                    'updated_at'  => now(),
                    'flag_active' => PersonalAccessToken::INACTIVE
                ]);
            });

            return [
                'status'  => true,
                'message' => 'Success destroy token'
            ];
        }
        catch (Exception $e)
        {
            return [
                'status'  => false,
                'message' => 'Failed destroy token',
                'error'  => $e->getMessage()
            ];
        }
    }
}
