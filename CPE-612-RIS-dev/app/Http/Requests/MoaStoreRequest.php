<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MoaStoreRequest extends FormRequest
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
            'title' => 'required|string',
            'mou_id' => 'integer|exists:mous,id',
            'departments' => 'array|required_without:department_custom',
            'department_custom' => 'string|required_without:departments|nullable',
            'detail' => 'required|string',
            'made_agreement_at' => 'required|date',
            'started_at' => 'required|date',
            'ended_at' => 'required|date',
            'attachment' => 'file|nullable'
        ];
    }
}
