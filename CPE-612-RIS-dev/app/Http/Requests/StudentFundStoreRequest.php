<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentFundStoreRequest extends FormRequest
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
            'outbound_student_id' => 'required|integer|exists:outbound_students,id',
            'student_fund_type_id' => 'required|integer|exists:student_fund_types,id',
            'name' => 'required|string',
            'amount' => 'required|numeric'
        ];
    }
}
