<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->is('admin*') && !$request->is('api*') && !$request->ajax()) {
            $ip = $request->ip();
            
            // Cek apakah IP ini sudah berkunjung dalam 24 jam terakhir
            $recentVisit = \App\Models\Visitor::where('ip_address', $ip)
                ->where('created_at', '>=', now()->subHours(24))
                ->exists();

            if (!$recentVisit) {
                \App\Models\Visitor::create([
                    'ip_address' => $ip,
                    'user_agent' => $request->userAgent(),
                    'visited_url' => $request->fullUrl(),
                ]);
            }
        }

        return $next($request);
    }
}
