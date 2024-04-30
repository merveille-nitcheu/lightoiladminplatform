<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getallproduct()
    {
        return ProductResource::collection(Product::orderByDesc('created_at')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeproduct(ProductRequest $request)
    {



        $prefix = strtoupper(substr($request->name, 0, 3));
        $randomChars = rand(1000, 5000);
        $code = $prefix . $randomChars;

        try {
            $product = Product::firstOrCreate([
                'code' => $code,
                'name' => $request->name,
                'price' => $request->price,

            ]);

            return response()->json([
                "message" => "Produit créee avec succès",
                "data" => new ProductResource($product)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Echec de la creation de produit",
                "error" => $th
            ], 500);
        }
    }

    public function showproduct(string $productId)
    {
        $product = Product::findOrFail($productId);


        $ss = [];
        $nbservice = 0;


        $servicestations = $product->stationProducts;
        foreach ($servicestations as $key => $servicestation) {

            $services = $servicestation->serviceStation;
            array_push($ss, $services);
        }
        $ss = array_filter($ss); // Filtrer les valeurs null du tableau
        $nbservice = count($ss);


        $datasupp = [
            'servicestation' => $ss,
            'nbservice' => $nbservice,
        ];
        return response()->json([
            "message" => "Produit créee avec succès",
            "data" => new ProductResource($product),
            "datasupp" => $datasupp,

        ], 200);
    }



    /**
     * Update the specified resource in storage.
     */
    public function updateproduct(Request $request, string $productId)
    {
        $product = Product::findOrFail($productId);

        try {
            $product->update([
                'name' => $request->name,
                'price' => $request->price,

            ]);

            return response()->json([
                "message" => "Produit modifié avec succès",
                "data" => new ProductResource($product)
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Echec de la modification de produit",
                "error" => $th
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyproduct($productId)
    {


        $product = Product::findOrFail($productId);
        try {
            $product->delete();
            return response()->json([
                "message" => "Produit supprimée avec succès",
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Echec de la suppression du produit",
                "error" => $th
            ], 422);
        }
    }
}
