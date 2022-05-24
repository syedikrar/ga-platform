<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Models\CohortType;
use App\Rules\ArabicText;

class CohortTypeRequest extends FormRequest
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
            'name_en'=> ['required', $this->cohort_type ? Rule::unique('cohort_types')->ignore($this->cohort_type->id) :Rule::unique('cohort_types')],
            'name_ar'=> ['required', new ArabicText('Cohort Type Arabic name must be in Arabic'), $this->cohort_type ? Rule::unique('cohort_types')->ignore($this->cohort_type->id) :Rule::unique('cohort_types')],
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
            'unique' => 'A cohort type with this name already exists.'
        ];
    }
    
}
