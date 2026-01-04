<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubCategoryRequest extends FormRequest
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
            'category_id'  => ['required'],
            'name'     => ['required', $this->id ? Rule::unique('subcategories', 'name')->where(function ($query) {
                $query->where('category_id', $this->category_id);
            })->ignore($this->id) : Rule::unique('subcategories', 'name')->where(function ($query) {
                $query->where('category_id', $this->category_id);
            })],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The Sub Category Name field is required',
            'category_id.required' => 'The Category Name field is required',
            // 'name.unique' => 'Nama Sub Kategori ini sudah terdaftar',
        ];
    }
}
