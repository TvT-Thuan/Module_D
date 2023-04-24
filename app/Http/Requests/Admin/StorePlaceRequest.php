<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePlaceRequest extends FormRequest
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
            'channel' => 'required',
            'capacity' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'The :attribute is required',
            'capacity.integer' => ':attribute min :min',
            'capacity.min' => ':attribute min :min',
        ];
    }
}
