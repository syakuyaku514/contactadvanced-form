<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role, $guard = null)
    {
        // ガードが指定されていない場合に、デフォルトのガードを設定
        $guard = $guard ?: Auth::getDefaultDriver();

        Log::info('Checking role middleware', [
        'guard' => $guard,
        'role' => $role,
        'user' => Auth::guard($guard)->user()
    ]);

        // 認証されていないか、役割が一致しない場合のリダイレクト先を設定
        if (!Auth::guard($guard)->check() || Auth::guard($guard)->user()->role !== $role) {
            if ($guard === 'admin') {
                return redirect('/admin/login'); // 管理者ログインページにリダイレクト
            } elseif ($guard === 'owner') {
                return redirect('/owner/login'); // オーナーログインページにリダイレクト
            } else {
                return redirect('/'); // デフォルトのリダイレクト先
            }
        }

        return $next($request);
    }
}
