<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ArabicText implements Rule
{
    protected $message = 'The :attribute must be arabic.';
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($message="")
    {
        if (strlen($message)) {
            $this->message = $message;
        }
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if( preg_match("/[a-zA-Z0-9]/", $value) ) {
            return false;
        }
        return preg_match("/[א-ת]/", $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
