<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Rules\ArabicText;

class ChallengeRequest extends FormRequest
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
        switch(request()->getMethod()) {
            case "POST":
        return  [
            'name_en'        => ['required', $this->challenge ? Rule::unique('challenges')->ignore($this->challenge->id) :Rule::unique('challenges')],
            'name_ar'        => ['required', new ArabicText('Challenge Arabic name must be in Arabic'), $this->challenge ? Rule::unique('challenges')->ignore($this->challenge->id) :Rule::unique('challenges')],
            'description_en' => 'required',
            'description_ar' => ['required',new ArabicText('Challenge Arabic description must be in Arabic'),],
            'cohort'         => 'required|exists:cohorts,id',
            'lead_entity'    => 'required|exists:entities,id',
            'goal'           => 'nullable',
            'baseline'       => 'nullable',
            'thumbnail_icon' => 'required|image|mimes:jpeg,png,jpg',
            'sidebar_icon' => 'required|image|mimes:jpeg,png,jpg'
        ];
        case "PUT":
            return  [
                'name_en'        => ['required'],
                'name_ar'        => ['required', new ArabicText('Challenge Arabic name must be in Arabic')],
                'description_en' => 'required',
                'description_ar' => ['required',new ArabicText('Challenge Arabic description must be in Arabic'),],
                'cohort'         => 'required|exists:cohorts,id',
                'lead_entity'    => 'required|exists:entities,id',
                'goal'           => 'nullable',
                'baseline'       => 'nullable',
                'thumbnail_icon' => 'nullable|image|mimes:jpeg,png,jpg',
                'sidebar_icon' => 'nullable|image|mimes:jpeg,png,jpg'
            ];
        }
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
            'unique' => 'A Challenge with this name already exists.'
        ];
    }
    
}
