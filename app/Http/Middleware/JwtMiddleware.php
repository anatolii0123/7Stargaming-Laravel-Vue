<?php
/**
 * Created by PhpStorm.
 * Filename: JwtMiddleware.php
 * User: Orhan BAHAR
 * Date: 16.07.2021
 * Time: 15:11
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{

    /**
     * Handle an incoming request.
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => false, 'message' => 'Token is Invalid'], 401);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status' => false, 'message' => 'Token is Expired'], 401);
            }else{
                return response()->json(['status' => false, 'message' => 'Authorization Token not found'], 401);
            }
        }
        return $next($request);
    }
}
