<?php

namespace App\Http\Controllers;

use App\Http\Resources\JaugeResource;
use App\Models\Jauge;
use Illuminate\Http\Request;

class JaugeController extends Controller
{
    public function getalljauge()
    {
        return JaugeResource::collection(Jauge::orderByDesc('created_at')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storejauge(Request $request)
    {

        $sondeName = strtolower($request->name);

        $code = 'autres';

        if (strpos($sondeName, 'ultrasons') !== false) {
            $code = 'ultrasons';
        }

        try {
            $jauge = Jauge::firstOrCreate([
                'name' => $request->name,
                'code' => $code,
                'price' => $request->price,

            ]);

            return response()->json([
                "message" => "Jauge créee avec succès",
                "data" => new JaugeResource($jauge)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Echec de la creation de la jauge",
                "error" => $th
            ], 500);
        }
    }


    public function showJauge($jaugeId)
    {

        $jauge = Jauge::findOrFail($jaugeId);
        try {
            return response()->json([
                "message" => "Jauge visualisée avec succès",
                "data" => new JaugeResource($jauge),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Echec de la methode show",
                "error" => $th
            ], 422);
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function updatejauge(Request $request, string $jaugeId)
    {
        $jauge = Jauge::findOrFail($jaugeId);

        try {
            $jauge->update([
                'name' => $request->name,
                'price' => $request->price,

            ]);

            return response()->json([
                "message" => "Jauge modifié avec succès",
                "data" => new JaugeResource($jauge)
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Echec de la modification de jauge",
                "error" => $th
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyjauge($jaugeId)
    {


        $jauge = Jauge::findOrFail($jaugeId);
        try {
            $jauge->delete();
            return response()->json([
                "message" => "jauge supprimée avec succès",
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Echec de la suppression de la jauge",
                "error" => $th
            ], 422);
        }
    }

    public function getCodebyJaugeId($jaugeId)
    {
        $jauge = Jauge::findOrFail($jaugeId);
        if($jauge->code == 'ultrasons'){
            return response()->json([
                "message" => "Jauge à ultrasons",
                "response" => true
            ], 200);
        }else {
            return response()->json([
                "message" => "Autres jauges",
                "response" => false
            ], 200);
        }

        try {

        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Echec de la suppression de la jauge",
                "error" => $th
            ], 422);
        }
    }


}
