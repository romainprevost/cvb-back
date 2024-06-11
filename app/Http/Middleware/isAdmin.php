<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User; 


class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // vérifie si un user est connecté et si celui est admin

        /** 
         * @var User $user 
         **/

        $user = Auth::user();
        // dd($user);
        if (Auth::check() && $user->isAdmin()){
            return $next($request);
        }

        abort(403);
    }
}
