<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminOrUser
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
        if($request->user() or $request->user('admin'))
        {
            return $next($request);
        }

        $msg = "Access denied";
        
        if(request()->ajax())
        {
            //This is called from the front-end during the course of play.
            return response([
                        'message'=>$msg
                    ], 403);
        }
        {
            return redirect(route('login'))->with('status', $msg);
        }

        return false;
    }
}
