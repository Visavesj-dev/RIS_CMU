<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OutboundStudentStoreRequest extends FormRequest
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
            'student_type_id' => 'required|integer|exists:student_types,id',
            'student_id' => 'required|string|size:9',
            'prefix' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'department_id' => 'required|integer|exists:departments,id',
            'advisor_id' => 'required|integer|exists:lecturers,id',
            'telephone' => 'required|string',
            'email' => 'required|email',
            'passport_id' => 'required|string',

            'cooperation_name' => 'nullable|string',
            'project' => 'nullable|string',
            'travelled_at' => 'nullable|date',
            'returned_at' => 'nullable|date',
            'university' => 'nullable|string',
            'coordinator_name' => 'nullable|string',
            'coordinator_email' => 'nullable|email',
            'subject' => 'nullable|string',
            'accommodation' => 'nullable|string',
            'note' => 'nullable|string',

            'attachment_photo' => 'nullable|file',
            'attachment_passport' => 'nullable|file',
            'attachment_activity_report' => 'nullable|file',
            'attachment_travelling_report' => 'nullable|file',
            'attachment_other' => 'nullable|file'
        ];
    }
}
