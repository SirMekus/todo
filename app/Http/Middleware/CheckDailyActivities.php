<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Activity;

class CheckDailyActivities
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
        if(!request()->filled('id') and request()->filled('date'))
        {
            if(Activity::whereDate('due_date', request()->date)->count() >= 4)
            {
                $msg = "You can't create more than 4 activities per day. Please select another date.";

                if(request()->ajax())
                {
                    //This is called from the front-end during the course of play.
                    return response([
                        'message'=>$msg
                    ], 403);
                }
                {
                    return back()->with('status', $msg);
                }
            }
        }
        return $next($request);
    }
}
