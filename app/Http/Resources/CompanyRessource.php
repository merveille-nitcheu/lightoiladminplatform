<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'name' => ucfirst($this->name),
            'address' => $this->address,
            'id' => $this->id,
            'phone' => $this->phone,
            'website' => $this->website,
            'logo' => Storage::url($this->logo),
            'created_at' => $this->created_at,
            'display_name' =>  $this->display_name,
            'nbstations'=>  $this->serviceStations->count(),
            'servicestations'=> ServiceStationRessource::collection($this->whenLoaded('serviceStations')),
            'financialYear' => [
                'start_date' => optional($this->financialYear)->start_date,
                'expected_end_date' => optional($this->financialYear)->expected_end_date,

            ],

        ];
    }
}
