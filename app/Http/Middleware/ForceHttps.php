<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceHttps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // MAMPではHTTP_X_FORWARDED_PROTOがないため、if文を追加
        if (array_key_exists('HTTP_X_FORWARDED_PROTO', $_SERVER)) {
            if ($_SERVER["HTTP_X_FORWARDED_PROTO"] != 'https') {
                return redirect()->secure($request->getRequestUri());
            }
        }

        return $next($request);
    }
}
