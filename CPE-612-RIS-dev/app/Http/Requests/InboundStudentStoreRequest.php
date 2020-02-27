<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InboundStudentStoreRequest extends FormRequest
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
            'prefix' => 'required|string|in:Mr,Mrs,Ms,Dr',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'university' => 'required|string',
            'country'=> 'required|string',
            'email' => 'required|email',
            'passport_id' => 'required|string',
            'cooperation_name' => 'required|string',
            'project' => 'required|string',
            'arrived_at' => 'required|date',
            'departed_at' => 'required|date',
            'department_id' => 'required|integer|exists:departments,id',
            'lecturer_id' => 'required|integer|exists:lecturers,id',
            'degree' => 'required|string|in:ตรี,โท,เอก,อื่น ๆ',
            'student_id' => 'nullable|string',
            'telephone' => 'nullable|string',
            'subject' => 'nullable|string',
            'accommodation' => 'nullable|string',
            'note' => 'nullable|string',
            'attachment_photo' => 'nullable|file',
            'attachment_passport' => 'nullable|file',
            'attachment_other' => 'nullable|file'
        ];
    }
}
