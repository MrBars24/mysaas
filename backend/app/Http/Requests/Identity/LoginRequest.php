<?php

namespace App\Http\Requests\Identity;

use App\Domains\Identity\Data\LoginData;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'device_name' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function toDto(): LoginData
    {
        return new LoginData(
            email: $this->validated('email'),
            password: $this->validated('password'),
            deviceName: $this->validated('device_name')
        );
    }
}