<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Kullanıcı giriş yapmamışsa login'e yönlendir
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $user = Auth::user();

        // Kullanıcının role'ü yoksa erişimi reddet
        if (!$user->role) {
            abort(403, 'Access denied');
        }

        // Super Admin tüm sayfalara erişebilir
        if ($user->role->name === 'Super Admin') {
            return $next($request);
        }

        // Belirtilen role kontrolü
        if (in_array($user->role->name, $roles)) {
            return $next($request);
        }

        // Yetkisiz erişim
        abort(403, 'Access denied');
    }
}
