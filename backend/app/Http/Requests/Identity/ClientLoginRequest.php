<?php

namespace App\Http\Requests\Identity;

use App\Domains\Identity\Data\ClientLoginData;
use Illuminate\Foundation\Http\FormRequest;

class ClientLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone' => ['required', 'string', 'max:20'],
            'device_name' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function toDto(): ClientLoginData
    {
        return new ClientLoginData(
            phone: $this->validated('phone'),
            deviceName: $this->validated('device_name')
        );
    }
}