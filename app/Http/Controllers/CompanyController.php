<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\FinancialYear;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyRessource;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getallcompagnies()
    {
        return CompanyRessource::collection(Company::orderByDesc('created_at')->get());
    }



    /**
     * Store a newly created resource in storage.
     */
    public function storecompany(CompanyRequest $request)
    {
        try {
            $company = Company::firstOrCreate([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'logo' => $request->logo ? $request->logo->storeAs('images/App', $request->nom . '.' . $request->logo->extension(), 'public') : null,
                'website' => $request->website,
            ]);

            FinancialYear::firstOrCreate([
                'start_date' => $request->start_date,
                'expected_end_date' => $request->expected_end_date,
                'company_id' => $company->id,

            ]);

            return response()->json([
                "message" => "Entreprise créee avec succès",
                "data" => new CompanyRessource($company)
            ], 200);
        } catch (\Throwable $th) {

            return response()->json([
                "message" => "Echec de la creation de l'entreprise",
                "error" => $th
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function showcompany(string $companyId)
    {
        $company = Company::with('serviceStations')->findOrFail($companyId);

        try {
            return response()->json([
                "message" => "Entreprise visualisée avec succès",
                "data" => new CompanyRessource($company),
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
    public function updatecompany(CompanyRequest $request, string $companyId)
    {

        $company = Company::findOrFail($companyId);
        try {
            $company->update([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'display_name' => $request->display_name,
                'logo' => $request->logo ? $request->logo->storeAs('images/App', $request->name . '.' . $request->logo->extension(), 'public') : null,
                'website' => $request->website,

            ]);

            return response()->json([
                "message" => "Entreprise modifiée avec succès",
                "data" => new CompanyRessource($company)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Echec de la modification",
                "error" => $th
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroycompany($companyId)
    {    $company = Company::findOrFail($companyId);

        try {

            $company->delete();
            return response()->json([
                "message" => "Entreprise supprimée avec succès",
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Echec de la suppression",
                "error" => $th
            ], 422);
        }
    }
}
