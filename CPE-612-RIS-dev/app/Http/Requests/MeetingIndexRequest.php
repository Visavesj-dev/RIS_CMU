<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MeetingIndexRequest extends FormRequest
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
            'department' => 'integer|nullable|exists:departments,id',
            'status' => 'nullable|string|in:all,ongoing,concluded',
            'from' => 'date|nullable',
            'to' => 'date|nullable',
            'page' => 'integer',
            'size' => 'integer',
            'search' => 'string|nullable'
        ];
    }
}
