<?php

namespace App\Http\Middleware;

use App\Models\Camp;
use App\Models\Enroll;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class is_admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user->is_admin == false) {
            return response()->json([
                'message' => 'Kamu bukan admin!'
            ]);
        }

        
        return $next($request);
    }
}
