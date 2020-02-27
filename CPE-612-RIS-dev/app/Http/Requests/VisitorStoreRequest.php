<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitorStoreRequest extends FormRequest
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
            'university' => 'required|string',
            'country' => 'required|string',
            'note' => 'string|nullable',
            'description' => 'required|string',
            'started_at' => 'required|date',
            'ended_at' => 'required|date',
            'visited_at' => 'required|date',
            'attachment_group_photo' => 'file|nullable',
            'attachment_memento' => 'file|nullable',
            'attachment_meeting_summary' => 'file|nullable',
            'attachment_other' => 'file|nullable'
        ];
    }
}
