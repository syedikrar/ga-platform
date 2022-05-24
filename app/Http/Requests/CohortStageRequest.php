<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Models\Stage;
use App\Rules\ArabicText;

class StageRequest extends FormRequest
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
        $rules = [
            'name_en' => ['required', $this->stage ? Rule::unique('stages')->ignore($this->stage->id) :Rule::unique('stages')],
            'name_ar' => ['required', new ArabicText('Cohort Stage Arabic name must be in Arabic'), $this->stage ? Rule::unique('stages')->ignore($this->stage->id) :Rule::unique('stages')],
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
            'unique' => 'A cohort stage with this name already exists.'
        ];
    }
    
}
