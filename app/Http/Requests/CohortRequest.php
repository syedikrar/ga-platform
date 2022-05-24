<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Rules\ArabicText;

class CohortRequest extends FormRequest
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
            'name_en'    => ['required', $this->cohort ? Rule::unique('cohorts')->ignore($this->cohort->id) :Rule::unique('cohorts')],
            'name_ar'    => ['required', new ArabicText('Cohort Arabic name must be in Arabic'), $this->cohort ? Rule::unique('cohorts')->ignore($this->cohort->id) :Rule::unique('cohorts')],
            'type'       => 'required|exists:cohort_types,id',
            'lead_entity'=> 'nullable|exists:entities,id',
            'stage'      => 'required|exists:stages,id',
            'status'     => 'required',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date'
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
            'unique' => 'A cohort with this name already exists.'
        ];
    }
    
}
