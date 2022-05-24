<?php

namespace App\Http\Requests;

use App\Rules\ArabicText;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EventRequest extends FormRequest
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
        $rules =  [
            'subject_en' => 'required',
            'subject_ar' => ['required',new ArabicText('Subject Arabic name must be in Arabic')],
            'is_online' => 'nullable',
            'platform' => 'required_with:is_online',
            'meeting_link' => 'required_with:is_online|nullable|url',
            'start_date' => 'required',
            'end_date' => 'nullable|after:start_date',
            'type' => 'required',
            'event_on' => 'required',
            'event_on_id' => 'required_with:event_on',
            'event_on_id' => 'required',
            'location_en' => 'required_without:is_online',
            'location_ar' => ['required_without:is_online', 'nullable', new ArabicText('Location Arabic name must be in Arabic')],
            'longitude' => 'required_without:is_online',
            'latitude' => 'required_without:is_online'
        ];
        return $rules;
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['success' => false, 'message' => $validator->errors()->first()], 400)
        );
    }
    public function messages()
    {
        return [
            'location_ar.required_without' => 'Location In Arabic field in required',
            'location_en.required_without' => 'Location In English field in required',
            'longitude.required_without' => 'Longitude field in required',
            'longitude.required_without' => 'Latitude field in required',
            'platform.required_with' => 'Platform field in required',
            'meeting_link.required_with' => 'Meeting link field in required'
        ];
    }
}
