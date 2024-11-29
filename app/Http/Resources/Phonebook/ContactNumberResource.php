<?php

namespace App\Http\Resources\Phonebook;

use App\Enums\TypeNumbers;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactNumberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'company' => $this->company,
            'phone_type' => $this->phone_type,
            'phone_type_translate' => TypeNumbers::getTypeNumber($this->phone_type),
            'phone' => $this->phone,
            'email' => $this->email,
            'avatar' => $this->avatar
        ];
    }
}
