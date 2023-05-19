<?php

namespace App\Http\Middleware;

use App\Models\Camp;
use App\Models\Enroll as ModelsEnroll;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Enroll
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $user_id = $user->id;
        $camp_id = $request->route('id');
        $camp = Camp::findOrFail($camp_id);

       
        $isEnrolled = ModelsEnroll::where('user_id', $user_id)
            ->where('camp_id', $camp_id)
            ->exists();

        if ($isEnrolled) {
            return response()->json([
                'message' => 'Kamu sudah terdaftar di camp ini!'
            ]);
        }

        return $next($request);
    }
}
