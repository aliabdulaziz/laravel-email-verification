<?php

namespace Aliabdulaziz\LaravelEmailVerification\Middleware;

use Closure;

class VerifyEmail
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
        if (auth()->check() and isset(auth()->user()->email_verification)) {
            return redirect('email/verification');
        }

        return $next($request);
    }
}
