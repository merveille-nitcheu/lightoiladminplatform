<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class CompanyRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|min:9|numeric',
            'start_date' => 'required|date',
            'expected_end_date' => 'required|date',

        ];
    }
/*
     // messages errors
     public function messages(): array
     {
         return [


         ];
     }
     // show errors
     protected function failedValidation(Validator $validator)
     {

         $errors = (new ValidationException($validator))->errors();
         throw new HttpResponseException(response()->json(
             [
                 'error' => $errors,
                 'status_code' => 422,
             ],
             JsonResponse::HTTP_UNPROCESSABLE_ENTITY
         ));
     } */
}
