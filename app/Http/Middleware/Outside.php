<?php

namespace SISCOR\Http\Middleware;
use Illuminate\Support\Facades\Session;
use Closure;

class Outside
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
       if (strlen(Session::get("ID"))>0) {
         return redirect('user/panelAdmin');
       }

        return $next($request);
    }
}
