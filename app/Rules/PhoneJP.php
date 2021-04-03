<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneJP implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        if (preg_match('/[^-\d]/', $value)) {
            return false;
        }

        $test = sprintf('-%s-', $value);
        return strpos($test, '--') === false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This phone is not valid.';
    }
}
