<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOfferRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'description' => 'nullable|string|max:200',
            'price' => 'required|numeric|min:0|max:999999999',
            'negotiation' => 'required|boolean',
            'type' => 'required|string|max:25',
            'publication_date' => 'required|date',
            'status' => 'required|string|max:25',
            'tags' => 'nullable|string|max:100',
            'user_id' => 'required|exists:users,id',
        ];
    }

}
