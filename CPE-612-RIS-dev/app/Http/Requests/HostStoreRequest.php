<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HostStoreRequest extends FormRequest
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
            'visitor_id' => 'required|integer|exists:visitors,id',
            'name' => 'required|string',
            'position' => 'required|string'
        ];
    }
}
