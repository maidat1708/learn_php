<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Symfony\Component\HttpFoundation\Response;

class HandleThrottleRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    private ThrottleRequests $throttleRequests;
    public function __construct(ThrottleRequests $throttleRequests){
        $this->throttleRequests = $throttleRequests;
    }
    public function handle(Request $request, Closure $next, $maxAttempts = 60, $decayMinutes = 1): Response
    {
        return $this->throttleRequests->handle($request,$next, $maxAttempts, $decayMinutes);
    }
}
