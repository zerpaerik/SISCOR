<?php

namespace SISCOR\Http\Middleware;
use Illuminate\Support\Facades\Session;
use Closure;

class Inside
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
      if (Session::get("ID")=="") {
        return redirect('user');
      }
        return $next($request);
    }
}
