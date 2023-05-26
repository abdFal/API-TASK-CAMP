<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Enroll;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CompleteEnroll
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $camp_id = $request->route('camp_id');
        $data = Enroll::where('user_id', $user->id)->where('camp_id', $camp_id);
        if(!$data){
            return response()->json([
                'message' => 'anda belum mengenroll camp ini'
            ]);
        }
        return $next($request);
    }
}
