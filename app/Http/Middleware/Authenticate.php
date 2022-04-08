<?php

namespace App\Http\Middleware;

use App\Enums\StatusesEnum;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        if (auth()->guard('web')->check() && auth()->guard('web')->user()->status != StatusesEnum::ACTIVE_STATUS) {
            (new LoginController())->logout($request);
        }

        return $next($request);
    }
}
