<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMachine extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return parent::attributes(); // TODO: Change the autogenerated stub

        return [
            'name'=> __('machine\'s name')
        ];
    }

    public function messages()
    {
        return parent::messages(); // TODO: Change the autogenerated stub

        return [
            'description.required'=> __('Set a damned machine\'s description')
        ];
    }
}