<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostRequest extends FormRequest
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
    public function rules()
    {
        $rules = [


            'title' => 'required|min:10|max:235|unique:blog_posts,title',
            'body' => 'required',
        ];
        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $rules['title'] .= ',' . $this->route('id'); // Assuming your route parameter is named 'id'
        }
        return $rules;
    }
}
