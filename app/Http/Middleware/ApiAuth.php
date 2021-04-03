<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $accessToken = $request->header('Authorization');
            
            $tokenValid = \App\Models\Admin::checkTokenValid($accessToken);

            if (!$tokenValid)  throw new \App\Exceptions\ApiTokenNotMatchException;

            return  $next($request);
        } catch (\Exception $error) {
            throw $error;
        }
    }
}
