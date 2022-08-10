<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Services\Auth\AuthServices;

class AuthController extends Controller
{
    private $authServices;
    public function __construct(AuthServices $authServices)
    {
        $this->authServices = $authServices;
    }

    public function login(Request $request)
    {
        try
        {
            $data = $this->authServices->checkLogin($request);
            return response()->json($data);
        }
        catch (\Exception $e)
        {
            return response()->json([
                'status'  => false,
                'message' => 'Login gagal',
                'error'   => $e->getMessage()
            ]);
        }
    }

    public function register(Request $request)
    {
        try
        {
            $user = $this->authServices->register($request);
            return response()->json([
                'status'  => true,
                'message' => 'Registrasi berhasil'
            ]);
        }    
        catch (\Exception $e)
        {
            return response()->json([
                'status'  => false,
                'message' => 'Registrasi gagal',
                'error'   => $e->getMessage()
            ]);
        }
    }

    public function refresh(Request $request)
    {
        try
        {
            $data = $this->authServices->refreshToken($request);
            return response()->json($data);
        }
        catch (\Exception $e)
        {
            return response()->json([
                'status'  => false,
                'message' => 'Failed refresh token',
                'error'   => $e->getMessage()
            ]);
        }
    }

    public function me(Request $request)
    {
        try
        {
            $user = $this->authServices->currentUser($request);
            return response()->json([
                'status' => true,
                'data'   => $user
            ]);
        }
        catch (\Exception $e)
        {
            return response()->json([
                'status'  => false,
                'message' => 'Failed me',
                'error'   => $e->getMessage()
            ]);
        }
    }

    public function logout(Request $request)
    {
        try
        {
            $data = $this->authServices->destroyToken($request);
            return response()->json($data);
        }
        catch (\Exception $e)
        {
            return response()->json([
                'status'  => false,
                'message' => 'Logout gagal',
                'error'   => $e->getMessage()
            ]);
        }
    }
}
