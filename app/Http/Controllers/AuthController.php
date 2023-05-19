<?php

namespace App\Http\Controllers;

use App\Http\Resources\CampResource;
use App\Http\Resources\EnrolledResource;
use App\Http\Resources\EnrollResource;
use App\Models\Camp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Enroll;


class AuthController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('logout', 'me');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);

    }
    return $user->createToken($user->name)->plainTextToken;
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(
            ['message' => 'Anda Telah Logout']
        );
    }

  public function me(Request $request)
    {
        $user = Auth::user();

        $userData = [
            'name' => $user->name,
            'email' => $user->email
        ];

        $enrolledCamps = Enroll::where('user_id', $user->id)->get();
        $enrolledCampIds = $enrolledCamps->pluck('camp_id')->toArray();

        $camps = Camp::whereIn('id', $enrolledCampIds)->get();

        return response()->json([
            'user' => $userData,
            'enrolled_camps' => EnrolledResource::collection($camps)
        ]);
    }


}
