<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'min:3', 'max:255'],
            'slug' => ['required', 'min:3', 'max:255', 'unique:posts'],
            'content' => ['required', 'min:3'],
            'excerpt' => ['required', 'min:3'],
            'categories' => ['array', 'exists:categories,id'],
            'thumbnail' => ['image', 'nullable',]
        ];
    }
}
