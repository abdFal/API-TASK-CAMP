<?php

namespace App\Http\Controllers;

use App\Http\Resources\EnrollResource;
use App\Models\Camp;
use App\Models\Enroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('enroll');
    }
    public function enroll(Request $request, $id)
    {
        
        $user_id = Auth::user()->id;
        $camp = Camp::findOrFail($id);
        
        $data = Enroll::create([
            'user_id' => $user_id,
            'camp_id' => $camp->id,
        ]);

        return response()->json([
            'message' => 'enroll berhasil!'
        ]);
    }

}
