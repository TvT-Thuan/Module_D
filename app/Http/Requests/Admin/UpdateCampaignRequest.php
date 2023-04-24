<?php

namespace App\Http\Requests\Admin;

use App\Models\Campaign;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCampaignRequest extends FormRequest
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
            'name' => [
                'required',
            ],
            'slug' => [
                'bail',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                'unique:campaigns,slug,' . $this->campaign->id,
            ],
            'date' => [
                'date_format:Y-m-d',
            ]
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'slug.unique' => 'Slug is already used.',
            'slug.regex' => "Slug must not be empty and only contain a-z, 0-9 and'-'.",
            'date.date_format' => 'Date must not be empty and only format yyyy-mm-dd',
        ];
    }
}
