<?php

namespace App\Http\Requests;

use App\Http\Controllers\CardController;
use App\Models\Card;
use Illuminate\Foundation\Http\FormRequest;

class StoreCard extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'balance' => 'required|numeric|gte:0',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'serial_number' => CardController::getNewSerialNumber()
        ]);
    }
}