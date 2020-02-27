<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MouStoreRequest extends FormRequest
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
            'type' => 'required|integer|exists:mou_types,id',
            'partners.*.name' => 'required|string',
            'partners.*.country' => 'required|string',
            'departments' => 'array|required_without:department_custom',
            'department_custom' => 'string|required_without:departments|nullable',
            'detail' => 'required|string',
            'made_agreement_at' => 'required|date',
            'started_at' => 'required|date',
            'ended_at' => 'required|date',
            'attachment' => 'file|nullable'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            // 'type.required' => 'A title is required',
            // 'body.required'  => 'A message is required',
        ];
    }
}
