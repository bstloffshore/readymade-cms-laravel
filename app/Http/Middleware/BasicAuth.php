<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class BasicAuth
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
	    $envs = [
		    'development'
	    ];
	    header('Cache-Control: no-cache, must-revalidate, max-age=0');
	    //$user = Cache::remember('user', 24*60, function (){return Auth::user();});
	    $user = Auth::user();
	    if(!$user && in_array(env('APP_ENV'), $envs)) {
		    if($request->getUser() != env('BASIC_AUTH_USERNAME') || $request->getPassword() != env('BASIC_AUTH_PASSWORD')) {
			    $headers = array('WWW-Authenticate' => 'Basic');
			    //$logger->info('Unauthorized HTTP Access');
			    return response('Unauthorized', 401, $headers);
		    }
	    }
        return $next($request);
    }
}
