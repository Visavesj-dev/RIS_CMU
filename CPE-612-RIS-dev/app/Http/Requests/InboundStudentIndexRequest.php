<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InboundStudentIndexRequest extends FormRequest
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
            'department' => 'integer|nullable|exists:departments,id',
            'type' => 'integer|nullable|exists:student_types,id',
            'status' => 'string|nullable|in:not-arrived,not-departed',
            'page' => 'integer',
            'size' => 'integer',
            'search' => 'string|nullable'
        ];
    }
}
