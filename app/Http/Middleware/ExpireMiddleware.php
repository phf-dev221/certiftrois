<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Bien;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExpireMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $biens = Bien::where('estExpire', 0)->get();

        foreach ($biens as $bien) {
            if (Carbon::parse($bien->created_at)->addMonths(3)->isPast()){
                $bien->estExpire = 1;
                $bien->save();
            }
        }
        return $next($request);
    }
    }
