<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'email' => 'required|regex:/^.+@.*cmu\.ac\.th$/i',
            'is_admin' => 'required|boolean',
            'has_research_read' => 'required|boolean',
            'has_research_write' => 'required|boolean',
            'has_service_read' => 'required|boolean',
            'has_service_write' => 'required|boolean',
            'has_meeting_read' => 'required|boolean',
            'has_meeting_write' => 'required|boolean',
            'has_foreign_read' => 'required|boolean',
            'has_foreign_write' => 'required|boolean'
        ];
    }
}
