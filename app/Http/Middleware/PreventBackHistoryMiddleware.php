<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventBackHistoryMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response =  $next($request);

        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('X-Permitted-Cross-Domain-Policies', 'master-only');
        $response->headers->set('X-Download-Options', 'noopen');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate, post-check=0, pre-check=0');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 26 Jul 1997 05:00:00 GMT');
        $response->headers->set('Content-Security-Policy', "frame-ancestors 'none'");

        // set method
        $response->headers->set('Access-Control-Allow-Origin', $request->header('Origin') ? $request->header('Origin') : '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, OPTIONS, DELETE');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, X-HTTP-Method-Override, X-XSRF-TOKEN');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');
        $response->headers->set('Access-Control-Expose-Headers', 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, X-HTTP-Method-Override, X-XSRF-TOKEN');
        $response->headers->set('Access-Control-Max-Age', '1728000');

        // Set a cookie
        $response->headers->setCookie(cookie('XSRF-TOKEN', csrf_token(), 60 * 24 * 365));
        $response->headers->setCookie(cookie('XSRF-TOKEN-OLD', csrf_token(), 60 * 24 * 365));
        $response->headers->setCookie(cookie('XSRF-TOKEN-NEW', csrf_token(), 60 * 24 * 365));
        $response->headers->setCookie(cookie('XSRF-TOKEN-OLD-NEW', csrf_token(), 60 * 24 * 365));
        $response->headers->setCookie(cookie('XSRF-TOKEN-NEW-OLD', csrf_token(), 60 * 24 * 365));
        $response->headers->setCookie(cookie('XSRF-TOKEN-OLD-NEW-OLD', csrf_token(), 60 * 24 * 365));
        $response->headers->setCookie(cookie('XSRF-TOKEN-NEW-OLD-NEW', csrf_token(), 60 * 24 * 365));

        // Handle session expiration manually (if required)
        if ($request->session()->has('logged_in')) {
            if (time() - $request->session()->get('last_activity') > 3600) { // 30 minutes
                $request->session()->invalidate();
                $request->session()->regenerate();
                return redirect()->route('admin.login');
            } else {
                $request->session()->put('last_activity', time());
            }
        } else {
            $request->session()->put('last_activity', time());
        }


        // Set a CSRF token
        $response->headers->set('X-CSRF-TOKEN', csrf_token());

        // Set a CSRF token in the session
        $request->session()->put('csrf_token', csrf_token());

        // Set a CSRF token in the session for AJAX requests
        if ($request->ajax()) {
            $request->session()->put('csrf_token', csrf_token());
            $request->session()->put('csrf_token_ajax', csrf_token());
        } else {
            $request->session()->forget('csrf_token_ajax');
        }

        // Set a CSRF token in the session for form submissions
        if ($request->isMethod('post')) {
            $request->session()->put('csrf_token', csrf_token());
            $request->session()->put('csrf_token_form', csrf_token());
        } else {
            $request->session()->forget('csrf_token_form');
        }
        return $response;
    }
}
