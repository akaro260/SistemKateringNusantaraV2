<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Hanya izinkan user dengan role 'admin' masuk ke route /admin/*.
     * Customer biasa yang nyasar ke sini akan ditolak (403).
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->isAdmin()) {
            abort(403, 'Halaman ini khusus untuk Admin.');
        }

        return $next($request);
    }
}
