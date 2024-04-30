<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceStationRessource extends JsonResource
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
            'city' => ucfirst($this->city),
            'id' => $this->id,
            'gmt' => $this->gmt,
            'latitude' => $this->latitude,
            'back_image_link' => Storage::url($this->back_image_link),
            'created_at' => $this->created_at,
            'longitude' =>  $this->longitude,
            'status' =>  $this->status,
            'description' =>  $this->description,
          'company' => [
                'name' => ucfirst(optional($this->company)->name)
            ],

        ];
    }
}
