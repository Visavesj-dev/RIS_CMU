<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitorIndexRequest extends FormRequest
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
            'year' => 'integer|nullable',
            'country_id' => 'integer|nullable|exists:countries,id',
            'page' => 'integer',
            'size' => 'integer',
            'search' => 'string|nullable'
        ];
    }
}
