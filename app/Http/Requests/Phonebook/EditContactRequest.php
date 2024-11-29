<?php

namespace App\Http\Requests\Phonebook;

use App\Enums\TypeNumbers;
use App\Models\Phonebook\ContactNumber;
use Illuminate\Foundation\Http\FormRequest;

class EditContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can("update", $this->contact);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:contact_numbers,id',
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
