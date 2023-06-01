<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $app = $request
            ->user()
            ->apps()
            ->where('name', $request->segment(1))
            ->first();

        $message = '';

        if(!$app) {
            $message = 'App no instalada: '.$request->segment(1);
        } else if($app->blocked_at != null) {
            $message = 'App bloqueada: '.$request->segment(1);
        } else {
            $page = $app
                ->pages()
                ->where(['controller' => $request->segment(2), 'action' => $request->segment(3)])
                ->first();
            if(!$page) {
                $message = 'Módulo no instalado: '.$request->segment(2).' -> '.$request->segment(3);
            }
        }

        if($message != '') {
            return back()->with('message', $message);
        }

        return $next($request);
    }
}
