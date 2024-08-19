<?php

namespace App\Http\Requests;

use App\Enums\WebhookTriggerEvents;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewWebhookSubscription extends FormRequest
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
            "url" => "required|string|url",
            "method" => "required|string|in:POST,PUT,PATCH",
            "secret" => "required|string",
            "event" => ["required", "string", Rule::enum(WebhookTriggerEvents::class)],
        ];
    }
}
