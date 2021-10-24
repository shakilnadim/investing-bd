<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() :array
    {
        $rules = [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required|string',
            'password' => ['required', Rules\Password::defaults()],
            'categories' => 'nullable'
        ];

        if ($this->method() === 'PATCH') {
            $rules['email'] = ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->route('user')->id)];
            $rules['password'] = ['nullable', Rules\Password::defaults()];
        }

        return $rules;
    }
}
