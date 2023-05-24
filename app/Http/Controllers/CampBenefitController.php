<?php

namespace App\Http\Controllers;

use App\Http\Resources\CampBenefitResource;
use App\Http\Resources\CampResource;
use App\Models\Camp;
use App\Models\CampBenefit;
use Illuminate\Http\Request;

class CampBenefitController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('is_admin');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'camp_id' => 'required|exists:camps,id',
            'name' => 'required'
        ]);

        $camp = CampBenefit::create($request->all());

        return response()->json([
            'message' => 'Benefit berhasil ditambah!'
        ]);
    }

    public function edit(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $camp = CampBenefit::findOrFail($id);
        $camp->update($request->all());

        return response()->json([
            'message' => 'benefit telah diupdate!'
        ]);
    }

    public function delete($id)
    {
        $camp = CampBenefit::findOrFail($id);
        $camp->delete();

        return response()->json([
            'message' => 'benefit telah dihapus'
        ]);
    }

    
}
