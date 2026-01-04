<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $validation = [];
        if($this->confirm_password != "" && $this->new_password != "") {
            $validation = ['min:8'];
        } else {
            if($this->confirm_password != "" && $this->new_password == "") {
                $validation = ['required'];
            }
        }

        return [
            'name' => ['required'],
            'email' => ['required','email', $this->id ? Rule::unique('users', 'email')->ignore($this->id) : 'unique:users,email'],
            'new_password' => $validation,
            'confirm_password' => ['same:new_password'],
        ];
    }

    /**
     * custom message
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'confirm_password.same' => 'The confirm password field must match password field.',
        ];
    }
}
