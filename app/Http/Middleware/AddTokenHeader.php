<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddTokenHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->bearerToken){
            if($request->hasCookie("_token")){
                $token = $request->cookie("_token");
                $request->headers->add(["Authorization" => "Bearer ".$token]);
            }
        }
        return $next($request);
    }
}
