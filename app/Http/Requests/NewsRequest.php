<?php

namespace App\Http\Requests;

use App\Models\News;
use App\Rules\EditorJsRequired;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class NewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return Gate::allows('create', News::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $parentCategory = function ($q){
            return $q->where('category_id', null);
        };
        $parentsChildCategory = function ($q){
            return $q->where('category_id', $this->parent_category);
        };

        $rules = [
            'title' => 'required|string',
            'slug' => 'required|string|unique:news|alpha_dash',
            'parent_category' => ['required', 'integer', Rule::exists('categories', 'id')->where($parentCategory)],
            'sub_category' => ['nullable', 'integer', Rule::exists('categories', 'id')->where($parentsChildCategory)],
            'meta' => 'nullable|string',
            'is_published' => 'nullable',
            'is_featured' => 'nullable',
            'featured_img' => 'required|image|max:5000',
            'featured_img_alt' => 'nullable|string',
            'description' => ['required', 'string', new EditorJsRequired],
            'short_description' => 'required|string|max:100',
            'start_date' => ['required', 'date_format:Y-m-d'],
            'end_date' => ['required', 'date_format:Y-m-d', function($attribute, $value, $fail) {
                if (strtotime($value) < strtotime($this->start_date)) $fail('The end date can not be smaller than start date');
            }],
        ];

        if ($this->method() === 'PATCH') {
            $rules['slug'] = ['required', 'string', 'alpha_dash', Rule::unique('news')->ignore($this->route('news')->id)];
            $rules['featured_img'] = 'nullable';
        }
        return $rules;
    }
}
