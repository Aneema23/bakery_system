<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SriLankaMobileNumber implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || ! preg_match('/^(?:0(?:7[0-8])|(?:\+94|0094)\s?7[0-8])[\s-]?\d{3}[\s-]?\d{4}$/', $value)) {
            $fail('The :attribute must be a valid mobile number.');
        }
    }
}