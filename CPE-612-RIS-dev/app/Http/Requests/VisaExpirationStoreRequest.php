<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisaExpirationStoreRequest extends FormRequest
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
            'inbound_student_id' => 'required|integer|exists:inbound_students,id',
            'expired_at' => 'required|date'
        ];
    }
}
