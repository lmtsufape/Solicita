<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckAluno
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
      if(!Auth::check()){
        return redirect('home');

      }
      if(Auth::user()->tipo=='aluno'){
        return $next($request);
      }

      else{
        return redirect('home');

      }

    }
}
