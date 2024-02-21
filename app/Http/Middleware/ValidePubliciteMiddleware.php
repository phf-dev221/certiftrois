<?php

namespace App\Http\Middleware;

use App\Models\Demande;
use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidePubliciteMiddleware
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
                ->where('estValide', 0)
                ->where(function ($query) use ($todayDate) {
                    $query->whereDate('date_debut', $todayDate);
                })
                ->get();
    
            foreach ($publicites as $publicite) {
                $dateDebut =  Carbon::parse($publicite->date_debut)->toDateString();
    
                if ($dateDebut === $todayDate->toDateString()) {
                    $publicite->estValide = 1;

                }
    
                $publicite->save();
            }
    
            return $next($request);
        }
    }
