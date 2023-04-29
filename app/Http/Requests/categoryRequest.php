<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class categoryRequest extends FormRequest
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
            'name' => "required|min:3|max:255|",

            'image' => 'mimes:png,jpg',

        ];
    }
    public function massage()
    {
        return [
            'name.required' => "enter the name",


            'image.mimes' => "the image must be png or jpg "


        ];
    }
}