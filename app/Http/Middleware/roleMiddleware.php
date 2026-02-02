<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class roleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        $user = $request->user();
        if($user){
            return redirect('/login');
        }
        $roles = explode(',', $roles);
        if(!in_array($user->role, $roles)){
            abort(403);
        }
        return $next($request);
    }
}
