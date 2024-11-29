<?php

namespace App\Http\Requests\Phonebook;

use App\Enums\TypeNumbers;
use Illuminate\Foundation\Http\FormRequest;

class CreateContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): \Illuminate\Contracts\Auth\Authenticatable
    {
        return auth()->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'nullable|string',
            'company' => 'nullable|string',
            'phone_type' => 'required|string',
            'phone' => 'required|string',
            'email' => 'nullable|email',
            'avatar' => 'nullable|file'
        ];
    }
}
