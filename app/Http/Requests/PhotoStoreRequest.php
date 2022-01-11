<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoStoreRequest extends FormRequest
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
            'attendee_id' => ['required', 'integer', 'exists:attendees,id'],
            'event_id' => ['required', 'integer', 'exists:events,id'],
            'path' => ['required', 'string'],
            'reviewed' => ['required'],
        ];
    }
}
