<?php

namespace App\Http\Controllers;

use App\Models\Tank;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ServiceStation;
use App\Models\StationProduct;
use App\Http\Requests\TankRequest;
use App\Http\Resources\TankRessource;

class TankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getalltank()
    {
        return TankRessource::collection(Tank::orderByDesc('created_at')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storetank(Request $request)
    {

        /* $service_station = ServiceStation::findOrFail($request->name_ss->id); */
        $response = json_decode($$request->name_ss);
        return response()->json([
            "message" => "Cuve créee avec succès",
            "data" =>$response->data->id
        ], 200);

        /* $product = Product::whereIn('code', $request->codeProduct)->get();
        $stationProduct = StationProduct::whereStrict('product_id', $product->id)
            ->where('service_station_id', $service_station->id)
            ->first();

        try {
            $tank = Tank::firstOrCreate([
                'abacus' => $request->abacus,
                'diameter' => $request->diameter,
                'liquid_type' => $request->liquid_type,
                'man_hole_height' => $request->logo,
                'sensor_depth' => $request->sensor_depth,
                'sensor_reference' => $request->sensor_reference,
                'station_product_id' => $stationProduct->id,
                'jauge_id' => $stationProduct->id,
                 'level_active_depotage'  => 1.2,


            ]);

            return response()->json([
                "message" => "Cuve créee avec succès",
                "data" => new TankRessource($tank)
            ], 200);
        } catch (\Throwable $th) {

            return response()->json([
                "message" => "Echec de la creation de la cuve",
                "error" => $th
            ], 422);
        } */
    }



    /**
     * Update the specified resource in storage.
     */
    public function updatetank(Request $request, string $tankId)
    {
        $tank = Tank::findOrFail($tankId);
        $service_station = ServiceStation::whereIn('name', $request->name_ss)->get();
        $product = Product::whereIn('code', $request->codeProduct)->get();
        $stationProduct = StationProduct::whereStrict('product_id', $product->id)
            ->where('service_station_id', $service_station->id)
            ->first();

        try {
            $tank->update([
                'abacus' => $request->abacus,
                'diameter' => $request->diameter,
                'file_path' => $request->file_path,
                'liquid_type' => $request->liquid_type,
                'man_hole_height' => $request->logo,
                'sensor_depth' => $request->sensor_depth,
                'sensor_reference' => $request->sensor_reference,
                'time_out' => $request->time_out,
                'pub_reference' => $request->pub_reference,
                'station_product_id' => $stationProduct->id,


            ]);

            return response()->json([
                "message" => "Cuve Modifiée avec succès",
                "data" => new TankRessource($tank)
            ], 200);
        } catch (\Throwable $th) {

            return response()->json([
                "message" => "Echec de la modification de la cuve",
                "error" => $th
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroytank(array $tankId)
    {
        $tank = Tank::findOrFail($tankId);
        try {
            // Supprimer les entreprises

                $tank->delete();
            return response()->json([
                "message" => "cuve supprimée avec succès",
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Echec de la suppression de la cuve",
                "error" => $th
            ], 422);
        }
    }
}
