<?php


namespace App\Actions\Fortify;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CaptchaValidation
{
    public function __invoke(Request $request, $next)
    {
        Validator::make($request->all(), 
            [ 
                'g-recaptcha-response' => 'required|captcha' 
            ],
            [
                'required' => 'Captcha verification faild, try again!',
                'captcha'  => 'Captcha verification faild, try again!'
            ]
        )->validate();

        return $next($request);
    }
}