<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;

use App\Models\PersonalAccessToken\PersonalAccessToken;

class VerifyToken
{
    public function handle(Request $request, Closure $next)
    {
        try
        {
            $personalAccessToken = PersonalAccessToken::where('token', $request->bearerToken())
                ->where('flag_active', PersonalAccessToken::ACTIVE)
                ->whereDate('expired_at', '>', date('Y-m-d'))
                ->whereTime('expired_at', '<', date('H:i:s'))
            ->first();

            if (!$personalAccessToken)
            {
                return response()->json([
                    'status'  => false,
                    'message' => 'Invalid token'
                ]);
            }
        }
        catch (Exception $e)
        {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ]);
        }
        return $next($request);
    }
}
