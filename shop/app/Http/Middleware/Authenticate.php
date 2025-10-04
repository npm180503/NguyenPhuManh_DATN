<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        $guards = $request->route()?->gatherMiddleware() ?? [];

        if (in_array('auth:frontend', $guards)) {
            return route('fr.login');
        }

        return route('login');
    }

    /**
     * Handle an incoming request.
     * Cho phép middleware auth nhận guard động
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     */
    public function handle($request, \Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [config('auth.defaults.guard')] : $guards;

        foreach ($guards as $guard) {
            if (\Auth::guard($guard)->check()) {
                $request->attributes->set('auth_guard', $guard);
                return $next($request);
            }
        }

        // Nếu không guard nào login, gọi redirectTo
        return $this->unauthenticated($request, $guards);
    }

    protected function unauthenticated($request, array $guards)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập hoặc phiên đã hết hạn.',
            ], 401);
        }
        return redirect()->guest($this->redirectTo($request));
    }
}
