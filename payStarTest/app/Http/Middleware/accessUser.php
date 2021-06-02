<?php

namespace App\Http\Middleware;

use Closure;
class accessUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    if (empty(auth()->user()->access)) {
        return response()->json( ['error'=>'not access']);
    }
    elseif  (auth()->user()->access) {
            return $next($request);
        }


    }
}
?>
