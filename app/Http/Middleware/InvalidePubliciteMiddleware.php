<?php

namespace App\Http\Middleware;

use App\Models\Demande;
use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InvalidePubliciteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
            $todayDate = Carbon::today();
    
            $publicites = Demande::where('estPaye', 1)
                ->where('estValide', 1)
                ->where(function ($query) use ($todayDate) {
                    $query->whereDate('date_fin', $todayDate);
                })
                ->get();
    
            foreach ($publicites as $publicite) {
                $dateFin =  Carbon::parse($publicite->date_fin)->toDateString();
    
                if ($dateFin === $todayDate->toDateString()) {
                    $publicite->estValide = 0;
                }
                $publicite->save();
            }
            return $next($request);
        }
    }
