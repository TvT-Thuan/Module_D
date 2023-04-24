<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionRequest extends FormRequest
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
            'type' => ['required',],
            'title' => ['required',],
            'participant' => ['required',],
            'place' => ['required',],
            'cost' => ['nullable', 'required_if:type,service', 'exclude_unless:type,normal', 'numeric', 'min:0'],
            'start' => ['required', 'date_format:Y-m-d H:i',],
            'end' => ['required', 'date_format:Y-m-d H:i', 'after:start'],
            'description' => ['required',],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'The :attribute is requied',
            'date_format' => 'The :attribute format yyyy-mm-dd HH:MM',
            'numeric' => 'The :attribute is number',
        ];
    }
}
