<?php

namespace OrlandoLibardi\PageBuildCms\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'name' => 'required',
            'status' => 'required|numeric',
            'meta_title' => 'required|string|max:90',
            'meta_description' => 'required|string|max:180',
            'contents' => 'required',
            'content'     => 'required'
        ];
    }
}
