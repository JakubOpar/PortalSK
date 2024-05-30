<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:20',
            'surname' => 'required|string|max:25',
            'email' => [
                'required',
                'string',
                'email',
                'max:40',
                'unique:users,email,',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
            ],
            'phone_number' => 'required|string|min:9|max:9',
            'login' => 'required|string|max:30|unique:users,login',
            'password' => 'required|string|max:100',
            'commitPassword' => 'required|string|max:100|same:password'
        ];
    }
}
