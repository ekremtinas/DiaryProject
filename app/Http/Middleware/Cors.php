<?php

namespace App\Http\Middleware;

use Closure;
use DebugBar\DebugBar;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $startTime;

    public function __construct() {
        $this->startTime = microtime(true);
    }
    public function handle($request, Closure $next)
    {

            return $next($request)
                ->header('Response-Time', date(microtime(true) - $this->startTime)*1000)
                ->header('Access-Control-Allow-Origin', "*")
                ->header('Access-Control-Allow-Credentials', 'true')
                ->header('Access-Control-Allow-Method', "PUT,POST,GET,DELETE,OPTIONS")
                ->header('Access-Control-Allow-Headers', "Origin,X-Requested-With, Content-Type, X-Token-Auth, Authorization");

    }


}
