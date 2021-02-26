<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MontBellAuth
{
    private $service;

    public function __construct(\App\Services\MontbellAPI $service)
    {
        $this->service = $service;
    }

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

            $loginToken = $request->header('Authorization');
            $member = $request->route()->parameter('member');
            if (!$this->service->isTokenValid($loginToken)) throw new \App\Exceptions\MontBellTokenNotValidException;
            if ($member['login_token'] != $loginToken)  throw new \App\Exceptions\MontBellTokenNotMatchException;

            return  $next($request);
        } catch (\Exception $error) {
            throw $error;
        }
    }
}
