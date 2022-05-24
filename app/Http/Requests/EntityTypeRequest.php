<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Models\EntityType;
use App\Rules\ArabicText;

class EntityTypeRequest extends FormRequest
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
            'name_en'=> ['required', $this->entity_type ? Rule::unique('entity_types')->ignore($this->entity_type->id) :Rule::unique('entity_types')],
            'name_ar'=> ['required', new ArabicText('Entity Type Arabic name must be in Arabic'), $this->entity_type ? Rule::unique('entity_types')->ignore($this->entity_type->id) :Rule::unique('entity_types')],
            'sector' => 'in:Government,Private Sector', 
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
            'unique' => 'An entity type with this name already exists.'
        ];
    }
    
}
