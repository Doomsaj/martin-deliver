<?php

namespace App\Http\Requests;

use App\Rules\UuidV7;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CourierLocationChangedRequest extends FormRequest
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
            "latitude" => "required|numeric|regex:/^\d{1,10}(\.\d{1,8})?$/",
            "longitude" => "required|numeric|regex:/^\d{1,11}(\.\d{1,8})?$/",
            "consignment_code" => ["required", new UuidV7()]
        ];
    }
}
