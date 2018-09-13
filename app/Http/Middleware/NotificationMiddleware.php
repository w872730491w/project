<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class NotificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            $notifications['comment'] = Auth::user()->notifications->where('type', 'App\Notifications\CommentNotification');
            $notifications['follow'] = Auth::user()->notifications->where('type', 'App\Notifications\UserFollowNotification');
            $notifications['likes'] = Auth::user()->notifications->where('type', 'App\Notifications\LikesNotification');
            $notifications['messages'] = Auth::user()->notifications->where('type', 'App\Notifications\MessagesNotification');
            view()->share('notifications', $notifications);
        }
        return $next($request);
    }
}
