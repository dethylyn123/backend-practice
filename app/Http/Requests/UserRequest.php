<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if (request()->routeIs('user.store')) {
            return [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:App\Models\User|max:255',
                'password' => 'required|min:8',
            ];
        } else if (request()->routeIs('user.update')) {
            return [
                'name' => 'required|string|max:255'
            ];
        } else if (request()->routeIs('user.email')) {
            return [
                'email' => 'required|string|email|max:255'
            ];
        } else if (request()->routeIs('user.password')) {
            return [
                'password' => 'required|confirmed|min:8'
            ];
        }
    }
}
