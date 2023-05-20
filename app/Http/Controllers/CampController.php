<?php

namespace App\Http\Controllers;

use App\Http\Resources\CampResource;
use App\Models\Camp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CampController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('is_admin')->only('create', 'edit', 'destroy');
    }
    public function index()
    {
        $camps = Camp::all();
        return CampResource::collection($camps);
    }

    public function show($id)
    {
        $camp = Camp::findOrFail($id);
        return new CampResource($camp);
    }

    function generateRandomString($length = 20) 
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
    return $randomString;
}

    public function create(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            // 'slug' => 'required|max:500',
        ]);

        if($request->file){
            $validated = $request->validate([
                'file' => 'mimes:png,jpg,jpeg|max:100000'
            ]);

            $fileName = $this->generateRandomString();
            $extension = $request->file->extension();

            Storage::putFileAs('images', $request->file, $fileName. '.'. $extension);

            $request['image'] = $fileName . '.'. $extension;
            
        }

        
        $camp = Camp::create($request->all());
        return new CampResource($camp);
    }

     public function edit(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            // 'slug' => 'required|max:500',
        ]);

        $camp = Camp::findOrFail($id);
        $camp->update($request->all());
        
        return response()->json([
            'message' => 'camp dengan id ' .$id . ' telah diupdate!'
        ]);
    }

    public function destroy($id)
    {
        $camp = Camp::findOrFail($id);
        $camp->delete();

        return response()->json([
            'message' => 'camp dengan id ' .$id . ' telah didelete'
        ]);
    }

}
