<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ArabicText;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TouchpointRequest extends FormRequest
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
        switch(request()->getMethod()) {
            case "POST":
                return [
                    'title_en' => 'required',
                    'title_ar' => ['required',new ArabicText('Title Arabic must be in Arabic')],
                    'subtitle_en' => 'required',
                    'subtitle_ar' => ['required',new ArabicText('Subtitle Arabic must be in Arabic')],
                    'default_image' => 'required|image|mimes:jpeg,png,jpg',
                    'done_image' => 'required|image|mimes:jpeg,png,jpg',
                ];
            case "PUT":
                return [
                    'title_en' => 'required',
                    'title_ar' => ['required',new ArabicText('Title Arabic must be in Arabic')],
                    'subtitle_en' => 'required',
                    'subtitle_ar' => ['required',new ArabicText('Subtitle Arabic must be in Arabic')],
                    'default_image' => 'nullable|image|mimes:jpeg,png,jpg',
                    'done_image' => 'nullable|image|mimes:jpeg,png,jpg',
                ];
        }
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['success' => false, 'message' => $validator->errors()->first()], 400)
        );
    }
}
