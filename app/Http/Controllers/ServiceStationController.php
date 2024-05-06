<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ServiceStation;
use App\Models\StationProduct;
use App\Http\Resources\TankRessource;
use App\Models\RemainingNotificationParameter;
use App\Http\Resources\ServiceStationRessource;

class ServiceStationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getallservicestation()
    {
        return ServiceStationRessource::collection(ServiceStation::where('status', 'actif')->orderByDesc('created_at')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeservicestation(Request $request)

    {

         $basicInformation = $request->basicInformation;
        $localisationInformation = $request->localisationInformation;
        $companyId = $request->basicInformation['entreprise']['id'];
        $products = $basicInformation['product_name'];



        $company = Company::findOrFail($companyId);
        try {


            $service_station= ServiceStation::firstOrCreate([
                'name' => $basicInformation['name'],
                'city' => $localisationInformation['ville'],
                'gmt' => $localisationInformation['fuseau_horaire'],
                'description' => $basicInformation['description'],
                'back_image_link' => $basicInformation['logo_ss']? $basicInformation['logo_ss']->storeAs('images/App', $basicInformation['name'] . '.' . $basicInformation['logo_ss']->extension(), 'public') : null,
                'latitude' => $localisationInformation['latitude'],
                'longitude' => $localisationInformation['longitude'],
                'company_id' => $company->id,
                'status' => 'actif',

            ]);

            RemainingNotificationParameter::firstOrCreate([
                'scdp_delay_day' => 15,
                'critic_limit' => 20,
                'service_station_id' => $service_station->id,


            ]);
            foreach ($products as $product) {
                $product = Product::where('code', $product['code'])->first();

                StationProduct::create([
                    'service_station_id' => $service_station->id,
                    'product_id' => $product->id,
                ]);
            }



            return response()->json([
                "message" => "ServiceStation créee avec succès",
                "data" => new ServiceStationRessource($service_station)
            ], 200);
        } catch (\Throwable $th) {

            return response()->json([
                "message" => "Echec de la creation de la station",
                "error" => $th
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function showservicestation(string $stationId)
    {
        $service_station = ServiceStation::findOrFail($stationId);

        try {

            $stationProducts = $service_station->stationProducts;
            $parameter = $service_station->remainingNotificationParameter;

        /* get number of tank for a service station */
        $totalTank = 0;
        $products = [];
        $tankList = [];
        foreach ($stationProducts as $key => $stationProduct) {

            $totalTank += $stationProduct->tanks->count();
            $tanks = $stationProduct->tanks->toArray();
            $tankList = array_merge($tankList, $tanks);
            array_push($products, $stationProduct->product);
        }

        $additionaldata = [
            'products' =>$products,
            'totalTanks'=>$totalTank,
            'Tanks'=>$tankList,
            'Parameter'=>$parameter,
        ];
            return response()->json([
                "message" => "Entreprise visualisée avec succès",
                "data" => new ServiceStationRessource($service_station),
                'additionaldata' =>$additionaldata
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
    public function updateservicestation(Request $request, string $stationId)
    {
        $product = Product::whereIn('code', $request->code)->get();

        $service_station = ServiceStation::findOrFail($stationId);
        $stationProduct = StationProduct::findOrFail($service_station->id);
        try {
            $service_station->update([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'display_name' => $request->display_name,
                'logo' => $request->logo ? $request->logo->storeAs('images/App', $request->nom . '.' . $request->logo->extension(), 'public') : null,
                'website' => $request->website,
            ]);


            $stationProduct->update([
                'service_station_id' => $service_station->id,
                'product_id' => $product->id,


            ]);


            return response()->json([
                "message" => "ServiceStation créee avec succès",
                "data" => new ServiceStationRessource($service_station)
            ], 200);
        } catch (\Throwable $th) {

            return response()->json([
                "message" => "Echec de la creation de l'entreprise",
                "error" => $th
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyservicestation($stationId)
    {
        $service_station = ServiceStation::findOrFail($stationId);
        try {
            // Supprimer les entreprises
            $service_station->status ='inactif';
            $service_station->save();
                $service_station->delete();

            return response()->json([
                "message" => "service station supprimée avec succès",
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Echec de la suppression de la station service",
                "error" => $th
            ], 422);
        }
    }
}
