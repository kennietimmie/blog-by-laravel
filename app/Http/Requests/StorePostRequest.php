<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    protected $post;
     public function __construct(?Post $post=null){
        $this->post = $post ?? new Post();
     }
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
            'slug' => ['required', 'min:3', 'max:255', $this->post->exists ? 'unique:posts,slug,' . $this->post->id : 'unique:posts'],
            'content' => ['required', 'min:3'],
            'excerpt' => ['required', 'min:3'],
            'categories' => ['array', 'exists:categories,id'],
            'thumbnail' => ['image', 'nullable',]
        ];
    }
}
