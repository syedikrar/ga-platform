<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Rules\ArabicText;

class EntityContactRequest extends FormRequest
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
            'entity'  => 'nullable|exists:entities,uuid',
            'title'   => 'required',
            'name_en' => 'required',
            'name_ar' => ['required', new ArabicText('Contact Arabic name must be in Arabic')],
            'avatar'  => 'nullable|image',
            'email'   => 'nullable',
            'remarks' => 'nullable',
            'phone'   => 'nullable|numeric|digits:9',
            'mobile'  => 'nullable|numeric|digits:9',
            'designation_en' => 'nullable',
            'designation_ar' => ['nullable', new ArabicText('Contact Arabic designation must be in Arabic')],
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
            'numeric' => 'The :attribute must contain numbers only.', 
            'unique' => 'An entity with this name already exists.'
        ];
    }
    
}
