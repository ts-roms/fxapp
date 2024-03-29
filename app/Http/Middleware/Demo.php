<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Response;

class Demo {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $notAllowed = "POST|PUT|PATCH|DELETE") {
        if (env('DEMO_MODE', 0) == 0) {
            return $next($request);
        }

        if (env('DEMO_MODE', 0) == 1 && auth()->user()->user_type == 'user') {
            if ($request->isMethod('POST') || $request->isMethod('PUT') || $request->isMethod('PATCH') || $request->isMethod('DELETE')) {
                if (!$request->ajax()) {
                    return back()->with('error', 'Sorry, This feature is disabled');
                } else {
                    return response()->json(['result' => 'error', 'message' => 'Sorry, This feature is disabled']);
                }
            }
        }

        if (env('DEMO_MODE', 0) == 2) {
            if(in_array($request->getMethod(), explode('|', $notAllowed))){
                if (!$request->ajax()) {
                    return back()->with('error', 'Sorry, This feature is disabled');
                } else {
                    return response()->json(['result' => 'error', 'message' => 'Sorry, This feature is disabled']);
                }
            }
        }

        return $next($request);
    }
}
