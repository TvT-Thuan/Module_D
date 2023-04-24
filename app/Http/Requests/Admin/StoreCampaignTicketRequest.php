<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCampaignTicketRequest extends FormRequest
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
                'bail',
                'required',
                'string'
            ],
            'cost' => [
                'bail',
                'required',
                'numeric'
            ],
            'special_validity' => [
                'nullable',
                'required_with:amount',
                'required_with:valid_until'
            ],
            'amount' => [
                'bail',
                'required_if:special_validity,amount',
                'exclude_unless:special_validity,amount',
                'integer',
                'min:1'
            ],
            'valid_until' => [
                'bail',
                'required_if:special_validity,date',
                'exclude_unless:special_validity,date',
                'date_format:Y-m-d H:i'
            ],
        ];
    }

    public function messages()
    {
        return [
            'required' => "The :attribute is required",
            'required_if' => "The :attribute is required",
            'required_with' => "Selectd :attribute or empty :values tickets",
            'amount.integer' => "Amount is integer",
            'amount.min' => "Amount min 1",
            'valid_until.date_format' => "Date is format yyyy-mm-dd HH:MM",
        ];
    }
}
