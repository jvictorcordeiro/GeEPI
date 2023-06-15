<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckFiscal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect(route('home'))->with('error', 'Você precisa estar logado para acessar essa página!');
        }
        if (Auth::user()->tipo_usuario_id == 2) {
            return $next($request);
        } else {
            return redirect(route('home'))->with('error', 'Você não possui privilégios para acessar essa página!');
        }
    }
}
