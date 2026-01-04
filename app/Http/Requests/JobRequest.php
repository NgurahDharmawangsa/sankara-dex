<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'subcategory_id' => ['required'],
            'title' => ['required', 'array', 'min:1'],
            'title.*' => ['required_with_all:title.*', 'string'],

            'duration' => ['required', 'array', 'min:1'],
            'duration.*' => ['required_with_all:duration.*', 'numeric'],

            // Validasi array description
            'description' => ['array'],
            'description.*' => ['nullable', 'string'],
        ];
    }
}
