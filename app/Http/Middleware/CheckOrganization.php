<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckOrganization
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
        if(Auth::check()) {
    
            $user_profile_type = Auth::user()->profile_type;
            
            if($user_profile_type == "App\Organization"){
                return $next($request);
            }
            else
            {
                return response("You have to be an organization");
            }
        }
        else
        {
            return redirect(route('login'));
        }
    }
}
