<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MeetingConcludeUpdateRequest extends FormRequest
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
            'actual_expenses' => 'required|numeric',
            'net_income' => 'required|numeric',
            'university_share' => 'required|numeric',
            'faculty_share' => 'required|numeric',
            'department_share' => 'required|numeric',
            'note' => 'string|nullable',
            'outcome' => 'string|nullable',
            'closed_at' => 'required|date',
            'meeting_summary' => 'file|nullable',
            'meeting_financial_report' => 'file|nullable',
        ];
    }
}
