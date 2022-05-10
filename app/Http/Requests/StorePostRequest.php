<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StorePostRequest extends FormRequest
{
    /**
     * The post instance
     */
    protected $post;

     public function __construct(?Post $post=null){
        $this->post = $post;
     }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::any(['update-post', 'delete-post', 'create-post'], $this->post);
        // return Gate::authorize('update-post', $this->post);
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
            'slug' => ['required', 'min:3', 'max:255',optional($this->post)->exists ? 'unique:posts,slug,' . optional($this->post)->id : 'unique:posts'],
            'content' => ['required', 'min:3'],
            'excerpt' => ['required', 'min:3'],
            'categories' => ['array', 'exists:categories,id'],
            'thumbnail' => ['image', 'nullable',]
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->slug),
        ]);
    }
}
