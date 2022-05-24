<?php

namespace App\Http\Requests;

use App\Rules\ArabicText;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AccWorkstreamRequest extends FormRequest
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
            
            'name_en' => 'required',
            'name_ar' => ['required',new ArabicText('Name Arabic  must be in Arabic')],
            'description_en' => 'required',
            'description_ar' => ['required',new ArabicText('Description Arabic  must be in Arabic')],
            'leader_id' => 'required',
            
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
            'leader_id.required' => 'Please Select Leader',
            
        ];
    }
}
