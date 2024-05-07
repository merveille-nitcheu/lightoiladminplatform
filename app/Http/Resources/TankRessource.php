<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TankRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'abacus' => $this->abacus,
            'diameter' => $this->diameter,
            'id' => $this->id,
            'file_path' => $this->file_path,
            'liquid_type' => $this->liquid_type,
            'created_at' => $this->created_at,
            'man_hole_height' =>  $this->man_hole_height,
            'sensor_depth' =>  $this->sensor_depth,
            'sensor_reference' =>  $this->sensor_reference,
            'time_out' =>  $this->time_out,
            'level_active_depotage' =>  $this->level_active_depotage,
            'jauge' =>  $this->jauge,
            'correction_data' =>  $this->correctionData,
            'pub_reference'=>  $this->pub_reference,
            'stationProduct' => [
                'nameproduct' => optional($this->stationProduct)->product,
                'name_stationservice' => optional($this->stationProduct)->serviceStation],

        ];
    }
}
