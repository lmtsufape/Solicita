<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckServidor
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
        return redirect('/')->with('error', 'É necessário estar logado para utilizar esta funcionalidade');
      }
      if(Auth::user()->tipo=='servidor'){
        return $next($request);
      }
      else{
        return redirect('home')->with('error', 'Você não possui privilégios para acessar esta funcionalidade');
      }
    }
}
