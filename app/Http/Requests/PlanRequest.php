<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Rules\ArabicText;

class PlanRequest extends FormRequest
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
            'parent_id'  => 'nullable|exists:plans,id',
            'challenge'  => 'required|exists:challenges,id',  
            'title_en'   => 'required' ,
            'title_ar'   => ['required', new ArabicText('Plan Arabic title must be in Arabic'),],
            'priority'   => 'in:Low,Medium,Urgent',
            'status'     => 'nullable',
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
           
        ];
    }
}
