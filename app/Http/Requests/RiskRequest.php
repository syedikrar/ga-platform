<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Rules\ArabicText;

class RiskRequest extends FormRequest
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
           
            'challenge'      => 'required|exists:challenges,id',  
            'title_en'       => 'required' ,
            'title_ar'       => ['required', new ArabicText('Risk Arabic title must be in Arabic'),],
            'description_en' => 'required' ,
            'description_ar' => ['required', new ArabicText('Risk Arabic description must be in Arabic'),],
            'impact'         => 'in:Low,Medium,High,Very High',
            'probability'    => 'in:Likely,Certain',
            'status'         => 'in:Open,Closed',
            'mitigation_plan_en'   => 'nullable' ,
            'mitigation_plan_ar'   => ['nullable', new ArabicText('Risk Arabic mitigation plan must be in Arabic'),],
            'mitigation_plan_file' => 'nullable',
            'identification_date'  => 'required',
            
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
           
        ];
    }
}
