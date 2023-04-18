<?php

namespace App\Http\Middleware;

use App\Models\Atividade;
use Closure;

class ResponderAtividade
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
//        $filtro['escolas'] = $filtro
//        $atividade = Atividade::findBy($filtro);

        return $next($request);
    }
}
