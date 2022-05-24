<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Rules\ArabicText;

class UserRequest extends FormRequest
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
        switch (request()->getMethod()) {
            case 'POST':
                return [
                    'name_en'       => 'required',
                    'name_ar'       => ['required', new ArabicText('Arabic Name must be in Arabic')],
                    'phone'         => 'required|regex:/^[0-9]+$/|min:9|max:9',
                    'email'         => 'required|email|unique:users',
                    'entity'        => 'sometimes|nullable|exists:entities,id',
                    'send_email'    => 'sometimes|nullable',
                    'challenge_id'  => 'sometimes|nullable',
                    'role'          => 'sometimes|nullable'
                ];
            case 'PUT':
                $id = $this->route('user');
                
                return [
                    'name_en'       => 'required',
                    'name_ar'       => ['required', new ArabicText('Arabic Name must be in Arabic')],
                    'phone'         => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
                    'email'         => ['required', 'email', 'unique:users,email,' . $id],
                    'entity'        => 'nullable|exists:entities,id',
                    'send_email'    => 'sometimes|nullable',
                    'challenge_id'  => 'sometimes|nullable',
                    'role'          => 'sometimes|nullable'
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
            'unique' => 'A User with this email already exists.'
        ];
    }
}
