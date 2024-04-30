<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TankRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'abacus' => 'required',
            'diameter' => 'required',
            'sensor_depth' => 'required',
            'sensor_depth' => 'required',
            'liquid_type' => 'required',
            'man_hole_height' => 'required',
            'station_product_id' => 'required',
        ];

    }
}
