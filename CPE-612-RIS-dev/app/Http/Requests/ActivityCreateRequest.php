<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityCreateRequest extends FormRequest
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
            'parent' => 'required|string|in:mou,moa',
            'mou_id' => 'required_if:parent,mou|integer|exists:mous,id',
            'moa_id' => 'required_if:parent,moa|integer|exists:moas,id',
        ];
    }
}
