<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PlaceNewConsignmentRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "receive_from.latitude" => "required|numeric|regex:/^\d{1,10}(\.\d{1,8})?$/",
            "receive_from.longitude" => "required|numeric|regex:/^\d{1,11}(\.\d{1,8})?$/",
            "receive_from.address" => "required|string",
            "receive_from.name" => "required|string|max:11",
            "receive_from.phone" => "required|string|max:11",

            "delivery_to.latitude" => "required|numeric|regex:/^\d{1,10}(\.\d{1,8})?$/",
            "delivery_to.longitude" => "required|numeric|regex:/^\d{1,11}(\.\d{1,8})?$/",
            "delivery_to.address" => "required|string",
            "delivery_to.name" => "required|string|max:11",
            "delivery_to.phone" => "required|string|max:11",
        ];
    }
}
