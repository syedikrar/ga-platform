<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Rules\ArabicText;
class EntityRequest extends FormRequest
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
            'name_en'   => ['required_without:is_existing','nullable', $this->entity ? Rule::unique('entities')->ignore($this->entity->id) :Rule::unique('entities')],
            'name_ar'   => ['required_without:is_existing','nullable', new ArabicText('Entity Arabic name must be in Arabic') , $this->entity ? Rule::unique('entities')->ignore($this->entity->id) :Rule::unique('entities')],
            'short_name'=> 'required_without:is_existing',
            'type'      => 'required_without:is_existing|nullable|exists:entity_types,id',
            'website'   => 'nullable',
            'email'     => 'nullable',
            'phone'     => 'nullable|numeric|digits:9',
            'fax'       => 'nullable',
            'address_en'=> 'nullable',
            'address_ar'=> ['nullable', new ArabicText('Entity Arabic address must be in Arabic') ],
            'longitude' => 'nullable',
            'latitude'  => 'nullable',
            'location'  => 'nullable',
            'logo'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
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
