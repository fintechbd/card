<?php

namespace Fintech\Card\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePrepaidCardRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer'],
            'user_account_id' => ['required', 'intger'],
            'type' => ['required', 'string'],
            'scheme' => ['required', 'string'],
            'name' => ['required', 'string'],
            'note' => ['nullable', 'string'],
            'instant_card_data' => ['array'],
            'instant_card_data.birth_date' => ['required', 'date'],
            'instant_card_data.phone' => ['required', 'integer'],
            'instant_card_data.phone_country_id' => ['required', 'integer'],
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
