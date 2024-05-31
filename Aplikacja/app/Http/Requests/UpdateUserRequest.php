<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
                'email',
                'unique:users,email,' . $this->route('id'),
                'max:40',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
            ],
            'phone_number' => 'required|string|min:9|max:9',
            'login' => [
                'required',
                'string',
                'unique:users,login,' . $this->route('id'),
                'max:30',
            ],
            'password' => 'nullable|string|max:100',
            'permission' => 'required|integer|in:1,2'
        ];
    }
}
