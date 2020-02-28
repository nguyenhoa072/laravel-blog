<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        return [
            'title' => 'required|max:100',
            // 'description' => 'required'
        ];    
    }
    
    // public function messages() 
    // {
    //     return [
    //         'title.required' => 'Tiêu đề bài viết không được bỏ trống',
    //         'description.required' => 'Nội dung bài viết không được bỏ trống'
    //     ];
    // }

    public function messages()
    {
        return [
            'required' => ':attribute không được bỏ trống'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Tiêu đề bài viết',
        ];
    }
    
}