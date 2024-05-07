<?php

namespace App\Http\Controllers;

use App\Models\Tank;
use App\Models\Jauge;
use App\Models\Record;
use App\Models\Product;
use App\Models\RawData;
use App\Models\ProbeSensor;
use Illuminate\Http\Request;
use App\Models\ServiceStation;
use App\Models\StationProduct;
use App\Models\Correction_datas;
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


        $service_station = ServiceStation::findOrFail($request->name_ss['id']);

        $product = Product::findOrFail($request->name_product['id']);

        $stationProduct = StationProduct::where('product_id', $product->id)
            ->where('service_station_id', $service_station->id)
            ->first();

        $jauge = Jauge::findOrFail($request->type_jauge['id']);
        $abacus = implode(';', $request->abacus);

        try {
            $tank = Tank::firstOrCreate([
                'abacus' => $abacus,
                'diameter' => $request->diameter,
                'liquid_type' => $request->liquid_type,
                'man_hole_height' => $request->man_hole_height,
                'sensor_depth' => $request->sensor_depth,
                'sensor_reference' => $request->sensor_reference,
                'station_product_id' => $stationProduct->id,
                'jauge_id' => $jauge->id,
                'level_active_depotage'  => 1.2,


            ]);
            Correction_datas::firstOrCreate([
                'tank_id'=>$tank->id,
                'data_level' => '0,1000,0;1001,2000,0;2001,3000,0;3001,4000,0;4001,5000,0',
                'data_temp' => '0,5,0;6,10,0;11,15,0;16,20,0;21,25,0;26,30,0;31,35,0;36,40,0;41,45,0;46,50,0',
                'data_pressure' => '0,5000,0;6000,10000,0;11000,15000,0;16000,20000,0;21000,25000,0;26000,30000,0;31000,35000,0;36000,40000,0;41000,45000,0;46000,50000,0'
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
        }
    }

    public function showtank($tankId)
    {


        try{

            $tank = Tank::findOrFail($tankId);
            $record = Record::where('tank_id',$tank->id)->first();
            $jauge_code = $tank->jauge->code;
            $raw_datas = null;
            $probe_sensors = null;

            if ($jauge_code =='ultrasons') {
                $raw_datas = RawData::where('refKit',$tank->sensor_reference)->first();
            } else {
                $probe_sensors = ProbeSensor::where('sensor_ref',$tank->sensor_reference)->first();
            }

            $additionaldata = [
                'record'=>$record,
                'raw_datas'=>$raw_datas,
                'probe_sensors'=>$probe_sensors,

            ];


            return response()->json([
                "message" => "Cuve créee avec succès",
                "data" => new TankRessource($tank),
                "additionaldata"=>$additionaldata
            ], 200);

        }catch (\Throwable $th){


            return response()->json([
                "message" => "Echec de la visualisation de la cuve",
                "error" => $th
            ], 422);

        }



    }

    /**
     * Update the specified resource in storage.
     */
    public function updatetank(Request $request, string $tankId)
    {
        $tank = Tank::findOrFail($tankId);
        $correction_datas = Correction_datas::where('tank_id',$tank->id);
        $abacus = implode(';', $request->abacusResults);
        $data_level = implode(';', $request->data_level);
        $data_temp = implode(';', $request->data_temp);
        $data_pressure = implode(';', $request->data_pressure);


        try {
            $tank->update([
                'abacus' => $abacus,
                'man_hole_height' => $request->man_hole_height,
                'sensor_depth' => $request->sensor_depth,
                'sensor_reference' => $request->sensor_reference,
                'level_active_depotage' => $request->level_active_depotage,


            ]);
            $correction_datas->update([

                'data_level' => $data_level,
                'data_temp' => $data_temp,
                'data_pressure' => $data_pressure,


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
    public function destroytank( $tankId)
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
