<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return Gate::allows('create', Category::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        $parentCategory = function ($q){
            return $q->where('category_id', null);
        };

        $rules = [
            'name' => 'required|string',
            'slug' => 'required|string|unique:categories|alpha_dash',
            'category_id' => ['nullable', 'integer', Rule::exists('categories', 'id')->where($parentCategory)],
            'meta' => 'nullable|string',
            'is_published' => 'nullable',
        ];

        if ($this->method() === 'PATCH') {
            $rules['slug'] = ['required', 'string', 'alpha_dash', Rule::unique('categories')->ignore($this->route('category')->id)];
        }
        return $rules;
    }
}
