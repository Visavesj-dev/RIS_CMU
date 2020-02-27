<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MeetingStoreRequest extends FormRequest
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
            'head_of_project' => 'required|string',
            'department_id' => 'required|integer|exists:departments,id',
            'budget' => 'required|numeric',
            'meeting_place' => 'required|string',
            'authorize_financial' => 'required|boolean',
            'authorize_other' => 'string|nullable',
            'started_at' => 'required|date',
            'ended_at' => 'required|date',
            'procurement_act' => 'required|string'
        ];
    }
}
